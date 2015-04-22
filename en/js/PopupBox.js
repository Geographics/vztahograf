Kauzality.PopupBox = function(){

	this.element = d3.select( "#popup-box" );
	this.$element = $( "#popup-box" );
	this.title = this.element.select( "h2" );
	this.isOpen = false;

	this.top;
	this.left;

	//this.element.classed( "right-position", true );
}

Kauzality.PopupBox.prototype = {

	show: function() {
		this.element.style( {"display":"block"} );
	},

	hide: function() {
		this.isOpen = false;

		this.element.style( {"display":"none"} );
		this.element.selectAll( "li" ).remove();
	},

	moveTo: function( left, top, animate ) {
		
		this.left = left;
		this.top = top;

		if( !animate ) this.element.style( { "top": this.top + "px", "left": this.left + "px" } );
		else this.$element.animate( { "top": this.top + "px", "left": this.left + "px" } );

	},

	showTitle: function( title, organization_abbr, color_mode ) {
		//remove displayed menu
		this.element.selectAll( "li" ).remove();

		this.show();
		
		if( color_mode == "parties" ) {

			if( !organization_abbr ) this.title.text( title );
			else this.title.text( title + " - " + organization_abbr );

		} else if( color_mode == "tags" ) {
			
			if( !organization_abbr ) { 
				this.title.text( title );
			}
			else {
				this.title.text( title + " - " + organization_abbr );
			}
		}
		
	},

	showMenu: function( names, links ) {

		var self = this;
		var filters = app.getFilters();
        var filtersLen = filters.length;
        var correctType = true;

        this.isOpen = true;
		
		var mappedData = [];
		for( var key in links ) {
			
			var arr = links[ key ];

			//TODO - can be probably optimized by breaking out of loop 
			//go through all links
			var linkLen = arr.length; 

			for( var q = 0; q < linkLen; q++ ) {

				//go through all nodes
				var link = arr[ q ];
				var nodes = link.nodes;
				
				//compute direction
				var personDirection = link.direction.concat();
				var personId = key;
				var linkFirstEntityId = link.fk_first_entity;
				//this has to be identical node_pers_12 to pers_12
				var personIdArr = key.split( "_" );
				if( personIdArr.length > 2 ) personId = personIdArr[1] + "_" + personIdArr[2];
				//is node first or second entity in relation
				var isFirstEntity = ( personId == link.fk_first_entity ) ? true : false;
				//if link is second and has "from relation", change to "to relation" 
				if( !isFirstEntity ) {
					if( personDirection == 1 ) personDirection = 2;
					else if( personDirection == 2 ) personDirection = 1;
				} 

				$.extend( link, { "personDirection": personDirection } );
				
				//just to double-check, link should always have two nodes
				if( nodes.length == 2 ) {

					//check if both nodes are of allowed type
					if( filters.indexOf( nodes[0].type ) == -1 || filters.indexOf( nodes[1].type ) == -1 ) {
						correctType = false;
						break;
					}
	
				}
				
			}
			
			if( correctType ) mappedData.push( { name: names[ key ], links:arr } );
			
		}
		
		this.element.classed( "selected", true );
		var lis = this.element.select( "ul" ).classed( "list", true ).selectAll( "li" )
			.data( mappedData );

		lis.enter().append( "li" )
			.html( function(d) { return "<a href='#'><div class='clearfix'><span>" + d.links.length + "</span><h3>" + d.name + "</h3></div><ul></ul></a>"; } );

		lis.select("ul").classed("sublist",true).selectAll( "li" )
			.data( function(d){ return d.links; } )
			.enter().append( "li" )
			.html( function(d){ return "<a href='#'><span class='" + self.getIconClassForDirection( d.personDirection ) + "'></span><h4>" + d.name + "</h4></a>";  } );

		//check if it has bottom postion classed and offset everything
		if( this.element.classed( "bottom-position" ) ) {
			//TODO - better offset menu
			this.top -= this.$element.height()-20;
			this.element.style( { top: this.top + "px" } );
		}

	},

	getIconClassForDirection: function( direction ) {
		
		var className = "relation-icon";
		if( direction == 1 ) className = "relation-icon-to";
		else if( direction == 2 ) className = "relation-icon-from";
		return className;

	}

}
	