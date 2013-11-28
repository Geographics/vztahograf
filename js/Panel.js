Kauzality.Panel = function() {

	var self = this;
	this.$document = $( document );
	this.element = d3.select( "#list-panel" );

	this.links = [];
	this.persons = [];
	this.organizations = [];

	this.linksSelection = [];
	this.personsSelection = [];
	this.organizationsSelection = [];

	this.$document = $( document );
    this.$document.on( Kauzality.ColorPanel.COLOR_UPDATE, function( event, radioVal ) {
        self.updateColors( radioVal );
    });

}

Kauzality.Panel.prototype = {

	update: function( data ) {

		this.clearSublists();

		//set keys
		this.links = [];
		this.persons = [];
		this.organizations = [];

		var len = data.length;
		for( var i = 0; i < len; i++ ) {

			var datum = data[ i ];
			if( datum instanceof Kauzality.Link ) {
				
				//see if filters are on and if the given element is hidden or not
				if( this.isElementVisible( datum.element ) ) this.links.push( datum );
				
			} else if( datum instanceof Kauzality.Node ) {

				if( datum.type == Kauzality.Node.PERSON_TYPE ) {
				
					if( this.isElementVisible( datum.element ) ) this.persons.push( datum );
				
				} else if( datum.type == Kauzality.Node.ORGANIZATION_TYPE ) {
				
					if( this.isElementVisible( datum.element ) ) this.organizations.push( datum );
				
				}
			}

		}

		//set numbers
		var total = this.persons.length + this.organizations.length + this.links.length;
		this.element.select( ".total span" ).text( total );

		//create categories
		if( this.persons.length > 0 ) this.personsSelection = this.createSublist( "Osoby", this.persons );
		if( this.organizations.length > 0 ) this.organizationsSelection = this.createSublist( "Organizace", this.organizations );
		if( this.links.length > 0 ) this.linksSelection = this.createSublist( "Vztahy", this.links );

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

		var liSelection = ul.selectAll( "li" )
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

		return liSelection;
	}, 

    updateColors: function( radioVal ) {

        if( radioVal == "tags" ) {
        	
        	this.personsSelection.text(  function( d ) { return ( d.data && d.data.tags_types_name && d.data.tags_types_name.name ) ? d.name + " - " + d.data.tags_types_name.name : d.name; } );

        } else if( radioVal == "parties" ) {
        	
        	this.personsSelection.text(  function( d ) { return ( d.data && d.data.organization_abbr ) ? d.name + " - " + d.data.organization_abbr : d.name; } );

        }

    }

}

Kauzality.Panel.NODE_OVER = "PanelNodeOverEvent";
Kauzality.Panel.NODE_OUT = "PanelNodeOutEvent";
Kauzality.Panel.NODE_CLICK = "PanelNodeClickEvent";