Kauzality.Node = function( id, data ) {

	this.id = id;
	this.data = data;
	this.name = data.name;
	this.links = [];

	//svg representation of node
	this.element;

	this.radialLocation = {};
	this.radialTagLocation = {};

	//decide on type
	this.type;
	if( this.id.indexOf( "pers_" ) > -1 ) {
		this.type = Kauzality.Node.PERSON_TYPE;
	} else if( this.id.indexOf( "org_" ) > -1 ) {
		this.type = Kauzality.Node.ORGANIZATION_TYPE;
	}
	
}

Kauzality.Node.prototype = {

	addLink: function( link, isSource ) {

		if( this.links ) {
			this.links.push( link );
		}

		//update references within link
		link.addNode( this, isSource );
		
	},

	getLinks: function() {
		
		//return all links grouped by ids
		var links = [];
		//store names of nodes
		var names = [];

		//check if neighbours are already build
		if( !this.neighbourNodes ) {
			this.updateNeighbours();
		} 
		
		//create empty arrays at key positions
		for( var id in this.neighbourNodes ) {
			links[ id ] = [];
			names[ id ] = this.neighbourNodes[ id ].name;
		}

		//go through all links and add them to links array based on id
		var linksLen = this.links.length;
		for( var i = 0; i < linksLen; i++ ) {

			var link = this.links[ i ];
			var linkNodes = link.nodes;

			//prepar vars
			var linkNode, linkId;

			if( linkNodes.length > 0 ) {
				linkNode = linkNodes[ 0 ];
				linkId = linkNode.id;
				
				if( linkId  != this.id ) links[ linkId ].push( link );
			}
		
			if( linkNodes.length > 1 ) {
				linkNode = linkNodes[ 1 ];
				linkId = linkNode.id;
				
				if( linkId  != this.id ) links[ linkId ].push( link );
			}

		}

		return { names: names, links: links };
		
	},

	updateNeighbours: function() {

		this.neighbourNodes = [];

		var linksLen = this.links.length;
		for( var i = 0; i < linksLen; i++ ) {
			
			var link = this.links[ i ];

			if( link.nodes.length > 0 ) {
				var firstNode = link.nodes[ 0 ];
				//check if node already in neighbours or is not itself
				if( firstNode.id != this.id && !this.neighbourNodes[ firstNode.id ] ) this.neighbourNodes[ firstNode.id ] = firstNode;
			}
			
			if( link.nodes.length > 1 ) {
				var secondNode = link.nodes[ 1 ];
				//check if node already in neighbours or is not itself
				if( secondNode.id != this.id && !this.neighbourNodes[ secondNode.id ] ) this.neighbourNodes[ secondNode.id ] = secondNode;
			}

		}

	},

	computeRadialLocation: function( center, angle, radius) {
    
        var x = (center.x + radius * Math.cos(angle * Math.PI / 180))
        var y = (center.y + radius * Math.sin(angle * Math.PI / 180))
        return {"x":x,"y":y};
	
	},

	getOrganizationClass: function() {
	
		return ( this.data.fk_organizations ) ? Kauzality.utils.OrganizationsUtil.getClassForOrganizationId( this.data.fk_organizations ) : null;
	
	},

	getTagClass: function() {
	
		return ( this.data.fk_tags_types ) ? Kauzality.utils.OrganizationsUtil.getClassForTagId( this.data.fk_tags_types ) : null;
	
	},

	addAngle: function( angle, isTag ) {

		var winWidth = $(window).width();
	    var winHeight = $(window).height();
	    var canvasCenter = { "x": winWidth/2, "y": winHeight/2 };
	    var radius = winWidth * .9;
	    
	    //compute radial location
		if( !isTag ) this.radialLocation = this.computeRadialLocation( canvasCenter, angle, radius );
		else this.radialTagLocation = this.computeRadialLocation( canvasCenter, angle, radius );

	}
   
}

Kauzality.Node.PERSON_TYPE = "KauzalityNodePersonType";
Kauzality.Node.ORGANIZATION_TYPE = "KauzalityOrganizationType";