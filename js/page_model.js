var PageModel = PageModel || {};

PageModel.TableHeadersTemplate = {
	ad_id: "hidden",
	ad_idprefix: "hidden",
	ad_fullid: "hidden",
	ad_sellerId: "hidden",
	ad_sellerName: "hidden",
	ad_sellerEmail: "hidden",
	ad_sellerPhone: "hidden",
	ad_sellerCategory: "hidden",
	ad_categoria: "hidden",
	ad_location: "hidden",
	ad_visits: "hidden",
	ad_comments: "hidden",
	ad_publicComments: "hidden",
	ad_messages: "hidden",
	ad_pictures: "hidden",
	ad_expires: "hidden",
	ad_marca: "visible",
	ad_modelo: "visible",
	ad_year: "visible",
	ad_status: "hidden",
	ad_legalstatus: "visible",
	ad_precio: "visible",
	ad_estado: "visible",
	ad_color: "visible",
	ad_centimetros: "visible",
	ad_motor: "visible",
	ad_combustible: "visible",
	ad_transmision: "visible",
	ad_kilometraje: "visible",
	ad_puertas: "visible",
	ad_postedOn: "hidden",
	ad_placa: "visible",
	ad_traccion: "visible",
	ad_carroceria: "visible",
	ad_detalles: "visible",
	ad_rating: "hidden",
	ad_voters: "hidden",
	ad_reports: "hidden",
	admin_verified: "hidden"
};

PageModel.FormattedHeaders = [
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'Marca',
								'Modelo', 
								'A&ntilde;o',	
								'&nbsp;', 
								'Estado Legal',	
								'Precio', 
								'Condici&oacute;n', 
								'Color', 
								'Cent&iacute;metros', 
								'Cilindros', 
								'Combustible', 
								'Transmisi&oacute;n', 
								'Kilometraje', 
								'Puertas', 
								'&nbsp;', 
								'Placa', 
								'Tracci&oacute;n', 
								'Carrocer&iacute;a', 
								'Detalles',
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;', 
								'&nbsp;'];
								
PageModel.DynamicVerbiage = {
	edit: "Editar",
	add: "Agregar"
};

PageModel.LegalStatus = {
	registered: "Registrado",
	customs: "En Aduana"
};

PageModel.Condition = [
	"Excelente",
	"Buena",
	"Regular",
	"Para repuestos"
];

PageModel.Cilinders = [
	"4 Cilindros",
	"6 Cilindros",
	"8 Cilindros",
	"10 Cilindros",
	"12 Cilindros"
];

PageModel.Fuel = [
	"Gasolina",
	"Diesel",
	"Electrico",
	"Hibrido",
	"Gas"
];

PageModel.Transmision = {
	manual : "Manual",
	auto: "Automatica"
};

PageModel.Traction = [
	"Delantera",
	"Trasera",
	"4 Ruedas",
	"4 Ruedas/Todo terreno"
];

PageModel.Bodytype = [
	"Sedan",
	"Station Wagon",
	"Sport Utility Vehicle (SUV)",
	"Hatchback",
	"Minivan",
	"Coupe",
	"Convertible",
	"Deportivo",
	"Pickup",
	"Van"
];
