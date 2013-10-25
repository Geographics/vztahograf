Kauzality.Link = function( link ) {
	
	$.extend( this, link );

	//adjust id
	this.ID_PREFIX = "link_";
	this.id = this.ID_PREFIX + this.id;

	this.nodes = [];

	this.source;
	this.target;
	
	//svg representation of link
	this.element;
	
	this.processedForFilter = false;


}

Kauzality.Link.prototype = {

	addNode: function( node, isSource ) {

		if( this.nodes ) {
			this.nodes.push( node );
		}

		if( isSource ) this.source = node;
		else this.target = node;

	}

}