Kauzality.Panel = function() {

	var self = this;
	this.$document = $( document );
	this.element = d3.select( "#list-panel" );

}

Kauzality.Panel.prototype = {

	update: function( data ) {

		this.clearSublists();

		//set keys
		var links = [];
		var persons = [];
		var organizations = [];

		var len = data.length;
		for( var i = 0; i < len; i++ ) {

			var datum = data[ i ];
			if( datum instanceof Kauzality.Link ) {
				
				//see if filters are on and if the given element is hidden or not
				if( this.isElementVisible( datum.element ) ) links.push( datum );
				
			} else if( datum instanceof Kauzality.Node ) {

				if( datum.type == Kauzality.Node.PERSON_TYPE ) {
				
					if( this.isElementVisible( datum.element ) ) persons.push( datum );
				
				} else if( datum.type == Kauzality.Node.ORGANIZATION_TYPE ) {
				
					if( this.isElementVisible( datum.element ) ) organizations.push( datum );
				
				}
			}

		}

		//set numbers
		var total = persons.length + organizations.length + links.length;
		this.element.select( ".total span" ).text( total );

		//create categories
		if( persons.length > 0 ) this.createSublist( "Osoby", persons );
		if( organizations.length > 0 ) this.createSublist( "Organizace", organizations );
		if( links.length > 0 ) this.createSublist( "Vztahy", links );

	},

	isElementVisible: function( element ) {
	
		return ( element && element.classed( "hidden" ) ) ? false : true;
	
	},

	clearSublists: function() {
		
		var sublists = this.element.selectAll( ".sublist" );
		sublists.remove();

	},

	createSublist: function( title, data ) {

		var self = this;
		var sublistDiv = this.element.append( "div" ).classed( "sublist", true );
		var headerDiv = sublistDiv.append( "div" ).classed( "header clearfix", true );
		var span = headerDiv.append( "span" ).text( data.length );
		var h2 = headerDiv.append( "h2" ).text( title );
		var ul = sublistDiv.append( "ul" );

		ul.selectAll( "li" )
			.data( data )
			.enter()
			.append( "li" )
			.attr( "data-id", function( d ) { return d.id; } )
			.text( function( d ) { return ( d.data && d.data.organization_abbr ) ? d.name + " - " + d.data.organization_abbr : d.name; } )
			.on( "mouseover", function( d ) {
				self.$document.trigger( Kauzality.Panel.NODE_OVER, [ d.id ] );
			})
			.on( "mouseout", function( d ) {
				self.$document.trigger( Kauzality.Panel.NODE_OUT, [ d.id ] );
			}).on( "click", function( d ) {
				self.$document.trigger( Kauzality.Panel.NODE_CLICK, [ d.id ] );
			});

	}

}

Kauzality.Panel.NODE_OVER = "PanelNodeOverEvent";
Kauzality.Panel.NODE_OUT = "PanelNodeOutEvent";
Kauzality.Panel.NODE_CLICK = "PanelNodeClickEvent";