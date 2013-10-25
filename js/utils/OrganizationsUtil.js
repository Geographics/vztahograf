Kauzality.utils.OrganizationsUtil = {

	getClassForOrganizationId: function( id ) {
		
		var className = "";
		switch( id ) {
			case "7":
				className = "ods";
				break;
			case "8":
				className = "top";
				break;
			case "9":
				className = "cssd";
				break;
			case "10":
				className = "kscm";
				break;
			case "15":
				className = "kdu-csl";
				break;
			case "16":
				className = "sz";
				break;
			case "29":
				className = "zeman";
				break;
			case "30":
				className = "lev";
				break;
			case "33":
				className = "ano";
				break;
		
		}
		return className;
	
	},

	getClassForTagId: function( id ) {
		
		var className = "";
		switch( id ) {
			case "1":
				className = "politician";
				break;
			case "3":
				className = "businessman";
				break;
			case "4":
				className = "lawyer";
				break;
			case "6":
				className = "manager";
				break;
			case "7":
				className = "economist";
				break;
			case "8":
				className = "lobbist";
				break;
			case "9":
				className = "judge";
				break;
			case "10":
				className = "bureaucrat";
				break;
			case "11":
				className = "developer";
				break;
			case "12":
				className = "executor";
				break;
			case "13":
				className = "advisor";
				break;
			case "14":
				className = "state-deputy";
				break;
			case "15":
				className = "policeman";
				break;
			case "17":
				className = "spokesperson";
				break;
			case "18":
				className = "syndicate";
				break;
		}
		return className;
	}
	
}