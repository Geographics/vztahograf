Kauzality.Graph = function( linkData ) {

    console.log( "linkData", linkData );

    var self = this;

    this.NODE_ID_PREFIX = "node_";

    this.linkData = linkData;

    this.selectedNode;
    this.nodes = new Kauzality.Nodes();
    this.popupBox = new Kauzality.PopupBox();
    this.links = [];
    this.highlightedElements = [];
    
    //flag to see if draging node or canvas
    this.lockCanvasDrag = false;

    //caching zoom values for moving popupbox
    this.lastTranslate;
    this.lastScale;

    this.colorMode = "parties";

    //add events
    this.$document = $( document );
    this.$document.on( Kauzality.Panel.NODE_OVER, function( event, id ) {
        self.highlightEntityById( id, true );
    }).on( Kauzality.Panel.NODE_OUT, function( event, id ) {
        self.highlightEntityById( id, false );
    }).on( Kauzality.Panel.NODE_CLICK, function( event, id ) {
        self.centerOnEntityById( id );
    }).on( Kauzality.FilterPanel.FILTERS_UPDATE, function( event ) {
        self.updateFilters();
    }).on( Kauzality.GroupPanel.GROUP_UPDATE, function( event, radioVal ) {
        self.updateGroup( radioVal );
    }).on( Kauzality.ColorPanel.COLOR_UPDATE, function( event, radioVal ) {
        self.updateColors( radioVal );
    });
   
    //map new data
    this.mapData( this.linkData );

    //update panel data
    var panelData = this.links.concat( d3.values( this.nodes.getNodes() ) );
    this.panel = new Kauzality.Panel();
    this.panel.update( panelData );
    
    //resizing
    this.$window = $(window);
    this.winWidth = this.$window.width(),
    this.winHeight = this.$window.height();

    this.svg = d3.select("body").append("svg")
        .attr("width", this.winWidth)
        .attr("height", this.winHeight);

    //create marker symbol - TODO - do not create extra definitions for marker over state
    this.svg.append("defs").append("marker")
        .attr("id", "arrowhead-end")
        .attr("refX", 6 ) /*must be smarter way to calculate shift*/
        .attr("refY", 2)
        .attr("markerWidth", 6)
        .attr("markerHeight", 4)
        .attr("orient", "auto")
        .append("path")
        .attr("d", "M 0,0 V 4 L4,2 Z"); 
    this.svg.append("defs").append("marker")
        .attr("id", "arrowhead-end-over")
        .attr("refX", 6 ) /*must be smarter way to calculate shift*/
        .attr("refY", 2)
        .attr("markerWidth", 6)
        .attr("markerHeight", 4)
        .attr("orient", "auto")
        .append("path")
        .style( "fill", "black" )
        .attr("d", "M 0,0 V 4 L4,2 Z"); 
     this.svg.append("defs").append("marker")
        .attr("id", "arrowhead-start")
        .attr("refX", 6 + 3 - 11) /*must be smarter way to calculate shift*/
        .attr("refY", 2)
        .attr("markerWidth", 6)
        .attr("markerHeight", 4)
        .attr("orient", "auto")
        .append("path")
        .attr("d", " M 4,0 V 4 L0,2 Z");
     this.svg.append("defs").append("marker")
        .attr("id", "arrowhead-start-over")
        .attr("refX", 6 + 3 - 11) /*must be smarter way to calculate shift*/
        .attr("refY", 2)
        .attr("markerWidth", 6)
        .attr("markerHeight", 4)
        .attr("orient", "auto")
        .append("path")
        .style( "fill", "black" ) 
        .attr("d", " M 4,0 V 4 L0,2 Z");//this is actual shape for arrowhead

    //resize handler
    this.$window.resize( function() {
        self.winWidth = self.$window.width();
        self.winHeight = self.$window.height();

        self.svg = d3.select("svg")
        .attr("width", self.winWidth)
        .attr("height", self.winHeight);
    });

    //zooming behaviour
    this.zoom = d3.behavior.zoom()
                    .scaleExtent( [.1, 4] )
    this.svg.call( this.zoom.on( "zoom", function( evt ) {
                       self.onZoom( evt );
                    }) );
    
    //set and cache initial zoom
    this.zoom.scale( .25 );
    this.zoom.translate( [ this.winWidth/2, this.winHeight/2] );
    
    this.gWrapper = this.svg.append( "g" ).classed( "wrapper", true );
    this.createGraph();

    //apply default translate/scale
    this.gWrapper.attr("transform", "translate(" + this.zoom.translate() + ")scale(" + this.zoom.scale() + ")");
    
}

Kauzality.Graph.prototype = {

    mapData: function( linkData ) {

        var self = this;
        
        //temp
        var len = linkData.length;
        var i = len;
        
        //group nodes 
        var organizationGroups = d3.map();
        var tagGroups = d3.map();
        var organization, tag;
        
        // Compute the distinct nodes from the links.
        linkData.forEach(function(linkDatum) {

            //create link object
            var link = new Kauzality.Link( linkDatum );
            self.links.push( link );

            //create node for first entity and add link
            var nodeId = self.NODE_ID_PREFIX + link.fk_first_entity;
            var node = self.nodes.getNodeById( nodeId );
            if( !node ) {
                node = new Kauzality.Node( nodeId, link.firstEntityInfo );
                self.nodes.addNode( node );
               
                organization = ( link.firstEntityInfo.fk_organizations ) ? link.firstEntityInfo.fk_organizations : -1;
                if( !organizationGroups.has( organization ) ) organizationGroups.set( organization, [ node ] );
                else organizationGroups.get( organization ).push( node );
                
                tag = ( link.firstEntityInfo.fk_tags_types ) ? link.firstEntityInfo.fk_tags_types : -1;
                if( !tagGroups.has( tag ) ) tagGroups.set( tag, [ node ] );
                else tagGroups.get( tag ).push( node );
               
            }
            node.addLink( link, true );
            
            //create node for second entity and add link
            nodeId = self.NODE_ID_PREFIX + link.fk_second_entity;
            node = self.nodes.getNodeById( nodeId );
            if( !node ) {
                node = new Kauzality.Node( nodeId, link.secondEntityInfo );
                self.nodes.addNode( node );

                organization = ( link.secondEntityInfo.fk_organizations ) ? link.secondEntityInfo.fk_organizations : -1;
                if( !organizationGroups.has( organization ) ) organizationGroups.set( organization, [ node ] );
                else organizationGroups.get( organization ).push( node );

                tag = ( link.secondEntityInfo.fk_tags_types ) ? link.secondEntityInfo.fk_tags_types : -1;
                if( !tagGroups.has( tag ) ) tagGroups.set( tag, [ node ] );
                else tagGroups.get( tag ).push( node );
            }
            node.addLink( link );
            
        });
        
        //sort groups 
        var startAngle = 0;
        var angle = startAngle;
        var groupGap = 20;
        var organizationGroupsLen = d3.values( organizationGroups ).length;
        var increment = ( 360 - groupGap*organizationGroupsLen ) / len;
        
        organizationGroups.forEach( function( organizationGroupKey ) {

            var organizationGroup = organizationGroups.get( organizationGroupKey );
            var orgGroupLen = organizationGroup.length;
            for( var z = 0; z < orgGroupLen; z++ ) {
             
                var node = organizationGroup[ z ];
                node.addAngle( angle, false );
                    
                if( z < ( orgGroupLen - 1 ) )  angle += increment;
            }

            //ended group, add angle
            angle += groupGap;

        });

        //reset values
        angle = startAngle;
        tagGroups.forEach( function( tagGroupKey ) {

            var tagGroup = tagGroups.get( tagGroupKey );
            var tagGroupLen = tagGroup.length;
            for( var z = 0; z < tagGroupLen; z++ ) {
             
                var node = tagGroup[ z ];
                node.addAngle( angle, true );
                    
                if( z < ( tagGroupLen - 1 ) )  angle += increment;
            }

            //ended group, add angle
            angle += groupGap;

        });


    
    },

    createGraph: function() {

        var self = this;

        this.force = d3.layout.force()
            .nodes( d3.values( this.nodes.getNodes() ) )
            //.nodes(d3.values(nodes))
            .links( this.links )
            .size( [ this.winWidth, this.winHeight ] )
            .linkDistance(160)
            .charge(-2000)
            .on( "tick", function( evt ) {
                self.tick( evt ); 
            })
            .start();

        // add the links and the arrows
        this.pathSelection = this.gWrapper.append("svg:g").selectAll("path")
            .data(self.force.links())
            .enter().append("svg:path")
            .attr("data-id", function(d){ return  d.id; } )
            .attr("class", "link")
            .attr("marker-end", function(d){ return ( d.direction == "1" ) ? "url(#arrowhead-end)" : null; } )
            .attr("marker-start", function(d){ return ( d.direction == "2" ) ? "url(#arrowhead-start)" : null; } ) ;

        /*this.textSelection = this.gWrapper.append( "svg:g" ).selectAll( "text" )
            .data( self.force.links() )
            .enter().append( "svg:g" );

        this.textSelection.append( "text" )
            .style( "font-family", "Source Sans Pro" )
            .attr( "transform", function(d) { return "translate( -" + d.name.length * 2 +  ", -10 )"; })
            .text( function(d){ return d.name; } );  */   

        // define the nodes
        this.nodeSelection = this.gWrapper.selectAll(".node")
            .data(self.force.nodes())
            .enter().append("g")
            .attr("data-id", function(d){ return d.id; } )
            .attr("class", "node")
            .call(self.force.drag)
            .on( "mouseover", function( d ) {
                self.onNodeMouseOver( d3.select( this ), d );
            })
            .on("mouseout", function( d ){
                self.onNodeMouseOut( d3.select( this ), d );
            })
            .on( "click", function(d){
                self.onNodeClick( d3.select( this ), d );
            }).on( "mousedown", function(d) {
                self.lockCanvasDrag = true;
            }).on( "mouseup", function(d) {
                self.lockCanvasDrag = false;
            });
        
        var r = 60;
        this.rectSelection = this.nodeSelection.append( "rect" );
        this.rectSelection.attr( "width", r )
            .attr( "height", r )
            //color according to organization
            .attr( "class", function( d ) { return d.getOrganizationClass(); } )
            //offset rect half way to imitate circle offset
            .attr( "transform", "translate( " + -r/2 + "," + -r/2 + ")" )
            .attr( "rx", function( d ) { return ( d.type == Kauzality.Node.PERSON_TYPE ) ? r/2 : r/6 ; } )
            .attr( "ry", function( d ) { return ( d.type == Kauzality.Node.PERSON_TYPE ) ? r/2 : r/6 ; } );
    },

    tick: function( evt ) {

        this.pathSelection.attr("d", function(d) {
            var dx = d.target.x - d.source.x,
                dy = d.target.y - d.source.y;
            return "M" + 
                d.source.x + "," + 
                d.source.y + "l" + 
                dx + "," + dy;
        });

        //find center for anchoring the label
        /*this.textSelection.attr( "transform", function(d) { 

            var offsetY = 0,
                dx = d.target.x - d.source.x,
                dy = d.target.y+20 - d.source.y,
                angleRad = Math.atan( dy/dx ),
                angleDeg = angleRad * 180/Math.PI,
                x = ( d.target.x + d.source.x ) / 2,
                y = ( d.target.y + d.source.y ) / 2;

            return "translate(" + x + "," + y + ") rotate(" + angleDeg + ")"; 
       
        });*/

        this.nodeSelection.attr( "transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; } );
        
        if( evt.alpha < .001 ) {
           this.force.stop();
        }
    },

    radialTick: function( evt ) {
       
        var nodeIndex = 0;

        var canvasCenter = { "x": self.winWidth/2, "y": self.winHeight/2 };
        //console.log( "canvaCenter", canvasCenter );
        var radius = self.winWidth/4;

        this.nodeSelection.attr( "transform", function(d) { 
            //var location = d.radialLocation;
            moveToRadialLayout( d, evt.alpha );
           
            //console.log( location );
            //return "translate(" + location.x + "," + location.y + ")"; 
            return "translate(" + d.x + "," + d.y + ")"; 
        });

        this.pathSelection.attr("d", function(d) {
            var dx = d.target.x - d.source.x,
                dy = d.target.y - d.source.y;
            return "M" + 
                d.source.x + "," + 
                d.source.y + "l" + 
                dx + "," + dy;
        });

        //stop force if damping low
        if( evt.alpha < .03 ) {
           this.force.stop();
        }

        function moveToRadialLayout( d, alpha ) {
            var k = alpha * .5;

            d.x += ( ( d.radialLocation.x - d.x ) * k );
            d.y += ( ( d.radialLocation.y - d.y ) * k );
           
        }
    
    },

    radialTagTick: function( evt ) {
       
        var nodeIndex = 0;

        var canvasCenter = { "x": self.winWidth/2, "y": self.winHeight/2 };
        //console.log( "canvaCenter", canvasCenter );
        var radius = self.winWidth/4;

        this.nodeSelection.attr( "transform", function(d) { 
            //var location = d.radialLocation;
            moveToRadialLayout( d, evt.alpha );
           
            //console.log( location );
            //return "translate(" + location.x + "," + location.y + ")"; 
            return "translate(" + d.x + "," + d.y + ")"; 
        });

        this.pathSelection.attr("d", function(d) {
            var dx = d.target.x - d.source.x,
                dy = d.target.y - d.source.y;
            return "M" + 
                d.source.x + "," + 
                d.source.y + "l" + 
                dx + "," + dy;
        });

        //stop force if damping low
        if( evt.alpha < .03 ) {
           this.force.stop();
        }

        function moveToRadialLayout( d, alpha ) {
            var k = alpha * .5;

            d.x += ( ( d.radialTagLocation.x - d.x ) * k );
            d.y += ( ( d.radialTagLocation.y - d.y ) * k );
           
        }
    
    },
    
    updateGroup: function( radioVal ) {

        var self = this;
        var relationTickCallback = function( evt ) { self.tick( evt ) };
        var radialTickCallback = function( evt ) { self.radialTick( evt ) };
        var radialTagTickCallback = function( evt ) { self.radialTagTick( evt ) };
        
        var callback;
        if( radioVal == "parties" ) callback = radialTickCallback;
        else if( radioVal == "tags" ) callback = radialTagTickCallback;
        else callback = relationTickCallback;
        
        this.force.on( "tick", callback );

        //reset links
        if( radioVal == "parties" || radioVal == "tags" ) { 
            this.force.links( [] ).charge(-1000);
        }
        else {
            this.force.links( this.links ).charge(-2000); 
        }
        //restart force
        this.force.start();
    
    }, 

    updateColors: function( radioVal ) {

        this.colorMode = radioVal;

        if( radioVal == "tags" ) {
            this.rectSelection.attr( "class", function( d ) { return d.getTagClass(); } )
        } else if( radioVal == "parties" ) {
            this.rectSelection.attr( "class", function( d ) { return d.getOrganizationClass(); } )
        }

    },

    onNodeMouseOver: function( targetNodeCircle, d ) {
        
        var targetNode = d;

        //check if there is selected element
        if( this.selectedNode && this.selectedNode != targetNode ) {
            //dehilights element
            this.closePopup();
            this.dehighlightElements();
        }


        //get links
        var links = targetNode.links;
        var linksLen = links.length;
        
        //highlight links
        for( var i = 0; i < linksLen; i++ ) {

            var link = links[ i ];
            var linkPath = d3.select( "path[data-id='" + link.id + "']" );
            linkPath.classed( "highlight", true );
            if( linkPath.attr( "marker-end" ) ) linkPath.attr( "marker-end", "url(#arrowhead-end-over)" );
            if( linkPath.attr( "marker-start" ) ) linkPath.attr( "marker-start", "url(#arrowhead-start-over)" );

            //TODO - put it on top - ugly
            var pathEl = linkPath[0][0];
            pathEl.parentNode.appendChild( pathEl );

            //TODO - check if not inserting twice 
            this.highlightedElements.push( linkPath );

            //highlight nodes of the links
            var nodes = link.nodes;
            var nodesLen = nodes.length;

            for( var q = 0; q < nodesLen; q++ ) {

                var node = nodes[ q ];
                var nodeCircle = d3.select( "g[data-id='" + node.id + "']" );
                nodeCircle.classed( "highlight", true );
                
                //TODO - check if not inserting twice 
                this.highlightedElements.push( nodeCircle );

            }
        }
        
        //position & display label
        var transformString = targetNodeCircle.attr( "transform" );
        //format from translate(a,b) to a,b
        var transform = transformString.replace(/translate\(|\)/g,"");
        //in ie translate separeted by space not comma 
        var transformArr = ( transform.indexOf( "," ) > -1 ) ? transform.split( "," ) : transform.split( " " );

        var offsetX = 50;
        var offsetY = 16;
        
        var x = parseInt( transformArr[0] );
        var y = parseInt( transformArr[1] );

        var zoomScale = this.zoom.scale();
        if( zoomScale ) {
            x *= zoomScale;
            y *= zoomScale;

            if( zoomScale < 1 ) offsetX *= Math.pow( zoomScale, .37 );
            else offsetX *= Math.pow( zoomScale, 1.1 );
        }

        var translate = this.zoom.translate();
        if( translate ) {
            x += translate[0];
            y += translate[1];
        }

        x += offsetX;
        y -= offsetY;

        this.popupBox.moveTo( x , y );

        console.log( "targetNode.data", targetNode.data );
        console.log( " targetNode.data.tags_types_name",  targetNode.data.tags_types_name );

        if( this.colorMode == "parties" ) this.popupBox.showTitle( targetNode.name, targetNode.data.organization_abbr, this.colorMode );
        else if( this.colorMode == "tags" ) this.popupBox.showTitle( targetNode.name, targetNode.data.tags_types_name, this.colorMode );

    },

    onNodeMouseOut: function( nodeCircle, d ) {

        if( nodeCircle.classed( "select" ) ) {
            //don't do anything
            return;
        }

        this.popupBox.hide();
        this.dehighlightElements();

    },

    onNodeClick: function( nodeCircle, d ) {

        this.selectedNode = nodeCircle;
        this.selectedNode.classed( "select", true );

        var node = d;
        var linksAndNames = node.getLinks();
        this.popupBox.showMenu( linksAndNames.names, linksAndNames.links );

        //check for viewport constraints
        //TODO - do not hardcode these values
        /*var popupWidth = 400;
        var lineHeight = 32;
        var linksLen = linksAndNames.links;
        var popupHeight = lineHeight * (linksLen+1);
        var x = this.popupBox.left, y = this.popupBox.top;

        var isRightPosition = ( x > ( this.winWidth - popupWidth ) ) ? true : false;
        var isBottomPosition = ( y > ( this.winHeight - popupHeight ) ) ? true : false;

        //is needed to change viewport
        if( isRightPosition || isBottomPosition ) {
            var translate = this.zoom.translate();
            var scale = this.zoom.scale();

            var dx = dy = 0;
            if( isRightPosition ) {
                dx = popupWidth * scale;
                translate[0] -= dx;
            }
            if( isBottomPosition ) {
                dy = popupHeight * scale;
                translate[1] -= dy;
            }
           
            this.zoom.translate( translate );
            this.updateZoom();
            
            //animate popup to new position
            this.popupBox.moveTo( x-dx, y-dy, true );
            console.log( "animate popup: ", this.popupBox.left, this.popupBox.top );
        }*/

    },

    closePopup: function() {

        if( this.selectedNode ) {
            this.selectedNode.classed( "select", false );
            this.selectedNode = null;
        }

        this.popupBox.hide();
        this.dehighlightElements();
    },

    dehighlightElements:  function() {

        var elementsLen = this.highlightedElements.length;
        for( var i = 0; i < elementsLen; i++ ) {
           var el = this.highlightedElements[i];
           el.classed( "highlight", false );

           if( el.attr( "marker-end" ) ) el.attr( "marker-end", "url(#arrowhead-end)" );
           if( el.attr( "marker-start" ) ) el.attr( "marker-start", "url(#arrowhead-start)" );

        }

        //clear selection
        this.highlightedElements = [];
    
    },

    highlightEntityById: function( id, highlight ) {
    
        var entity = d3.select( "svg [data-id='" + id + "']" );
        entity.classed("highlight", highlight );
       
    },

    centerOnEntityById: function( id ) {

        var entity = d3.select( "svg [data-id='" + id + "']" );
        var tagName = entity[0][0].tagName;
        var transformString, transform, transformArr;

        //is entity path or node?
        if( tagName == "g" ) {
            
            //is node
            transformString = entity.attr( "transform" );
            //format from translate(a,b) to a,b
            transform = transformString.replace(/translate\(|\)/g,"");
            //in ie translate separeted by space not comma 
            transformArr = ( transform.indexOf( "," ) > -1 ) ? transform.split( "," ) : transform.split( " " );
    
        } else if( tagName == "path" ) {

            //is path
            transformString = entity.attr( "d" );
            transformArr = transformString.split( "l" );
            
            //get rid of M in first
            transformArr[0] = transformArr[0].slice( 1 ); 
            var source = transformArr[0].split( "," );
            var target = transformArr[1].split( "," );
            
            var x = ( parseInt( source[0] ) ),// + parseInt( target[0] ) ) / 2,
                y = ( parseInt( source[1] ) );//+ parseInt( target[1] ) ) / 2;

            transformArr = [ x, y ];
            console.log( source, target, x, y );

        }
        
        var translate = [ -1 * parseInt( transformArr[0] ), -1 * parseInt( transformArr[1] ) ];
        var scale = this.zoom.scale();
        translate[ 0 ] *= scale;
        translate[ 1 ] *= scale;

        //move to the center
        translate[0] += this.winWidth/2;
        translate[1] += this.winHeight/2;

        //update cached value
        this.zoom.translate( translate );

        this.gWrapper
            .transition()
            .duration(250)
            .attr( "transform", "translate(" + translate + ")scale(" + this.zoom.scale() + ")" );

    },

    updateFilters: function() {
        
        //check if entities fulfill filter requirements
        var filters = app.getFilters();
        var filtersLen = filters.length;
        var correctType = false;
        
        //go through nodes and see what needs to be turned off
        var nodes = d3.values( this.nodes.getNodes() );
        var nodesLen = nodes.length;

        for( var i = 0; i < nodesLen; i++ ) {

            var node = nodes[i];
            var nodeId = node.id;
            var q = filtersLen;
            var correctType = false;
            for( var q = 0; q < filtersLen; q++ ) { //while( q-- >= 0 ) {
                
                var filter = filters[ q ];
                if( node.type == filter ) {
                    //condition met for at least one filter, no need to go further
                    correctType = true;
                    break;
                }
                
            }

            //turn on/off node
            var nodeCircle = ( node.element ) ? node.element : ( node.element = d3.select( "svg [data-id='" + nodeId + "']" ) );
            nodeCircle.classed( "hidden", !correctType );
            
        }

        //turn on/off its links according to visibility of nodes
        var linksLen = this.links.length;
        for( i = 0; i < linksLen; i++ ) {

            var link = this.links[ i ];
            var linkId = link.id;
            var hide = false;
            var nodes = link.nodes;
            var nodesLen = nodes.length;
           
            for( var q = 0; q < nodesLen; q++ ) {
                var node = nodes[q];
                var nodeCircle = node.element;
                if( nodeCircle.classed( "hidden" ) ) {
                    hide = true;
                    break;
                }
            }

            var linkPath = ( link.element ) ? link.element : ( link.element = d3.select( "svg [data-id='" + linkId + "']" ) );    
            linkPath.classed( "hidden", hide );
                       
        }

        var panelData = this.links.concat( d3.values( this.nodes.getNodes() ) );
        this.panel.update( panelData );
    },

    zoomIn: function() {
    
        var currentScale = this.zoom.scale();
        var viewportWidth = currentScale * this.winWidth;
        var viewportHeight = currentScale * this.winHeight;
        currentScale *= 1.25
        var newViewportWidth = currentScale * this.winWidth;
        var newViewportHeight = currentScale * this.winHeight;
        
        var diffX = newViewportWidth - viewportWidth;
        var diffY = newViewportHeight - viewportHeight;
        var translate = this.zoom.translate();
        translate[0] -= diffX/2;
        translate[1] -= diffY/2;
        this.zoom.translate( translate );
        this.zoom.scale( currentScale );
      
        this.updateZoom();
    
    },

    zoomOut: function() {
        
        var currentScale = this.zoom.scale();
        var viewportWidth = currentScale * this.winWidth;
        var viewportHeight = currentScale * this.winHeight;
        currentScale /= 1.25
        var newViewportWidth = currentScale * this.winWidth;
        var newViewportHeight = currentScale * this.winHeight;
        this.zoom.scale( currentScale );

        var diffX = newViewportWidth - viewportWidth;
        var diffY = newViewportHeight - viewportHeight;
        var translate = this.zoom.translate();
        translate[0] -= diffX/2;
        translate[1] -= diffY/2;
        this.zoom.translate( translate );

        this.updateZoom();
    
    },

    updateZoom: function() {

        this.gWrapper
            .transition()
            .duration(250)
            .attr( "transform", "translate(" + this.zoom.translate() + ")scale(" + this.zoom.scale() + ")" );
    
    },

    onZoom: function( evt ) {
        
        if( this.lockCanvasDrag ) { 
            this.zoom.translate( this.lastTranslate );
            this.zoom.scale( this.lastScale );
            return;
        }

        //update zoom constants
        this.gWrapper.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");

        if( this.popupBox.isOpen && this.lastTranslate && this.lastScale ) {

            //temp - check if scaling, close popup if yes
            //take care of scaling
            var dscale = this.lastScale - d3.event.scale;
            if( dscale == 0 ) {

                var x = this.popupBox.left, y = this.popupBox.top;
                //take care of translating
                var dx = this.lastTranslate[0] - d3.event.translate[0];
                var dy = this.lastTranslate[1] - d3.event.translate[1];

                var newX = x - dx;
                var newY = y - dy;

                this.popupBox.moveTo( newX, newY );

            } else {
                //temp - hide popup when scaling for now, cause i have no clue how to position it properly
                this.closePopup();
            }
                           
        }

        this.lastTranslate = d3.event.translate;
        this.lastScale = d3.event.scale;
    }

}


