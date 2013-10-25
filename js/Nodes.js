Kauzality.Nodes = function() {

	this.nodes = [];

}

Kauzality.Nodes.prototype = {

	addNode: function( node ) {

		if( node && node.id ) {
			this.nodes[ node.id ] = node;
		}
		
	},

	getNodes: function() {

		return this.nodes;

	},

	getNodeById: function( id ) {
		
		if( this.nodes ) {
			return this.nodes[ id ];
		}
		
		return null;
	
	},

	getNodeNameById: function( id ) {
		
		if( this.nodes && this.nodes[ id ] ) {
			return this.nodes[ id ].id;
		}

		return null;

	}


}