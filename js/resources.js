var resources = [];
var categories = [];
var types = [];

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function loadResources(category = 0, subcategory = 0, type = 0)
{
	$.ajax({
		type:'GET',
		url: 'includes/get_resources.php',
		data: {cat: category, sub: subcategory, typ: type},
		cache: false,
		success: function(result) {
			if(result)
			{
				resources = JSON.parse(result);
			}
		}
	});
}

function loadTypes()
{
	$.ajax({
		type: 'GET',
		url: 'includes/get_types.php',
		cache: false,
		success: function(result) {
			types = JSON.parse(result);
		}
	});
}

function loadCategories()
{
	$.ajax({
		type: 'GET',
		url: 'includes/get_categories.php',
		cache: false,
		success: function(result) {
			categories = JSON.parse(result);
		}
	});
}

function fillCategories()
{
	$("#categories").append('<option data-index="-1" value="0" selected="selected"></option>');
	$("#categories").append('<option data-index="-1" value="all">All</option>');
	for(var i = 0; i < categories.length; i++)
	{
		$("#categories").append('<option data-index="' +i+'" value="'+categories[i].ID+'">'+categories[i].Category+'</option>');
	}
}

function fillSubcategories()
{	
	var index = $("#categories").find(":selected").data("index");
	if(index != -1)
	{	
		var subcategories = categories[index].Subcategories;
		$("#subcategories").append('<option data-index="-1" value="0" selected="selected"></option>');
		$("#subcategories").append('<option data-index="-1" value="all">All</option>');
		for(var i = 0; i < subcategories.length; i++)
		{
			$("#subcategories").append('<option data-index="' +i+'" value="'+subcategories[i].ID+'">'+subcategories[i].Subcategory+'</option>');
		}
		
		$(".subcategories").show();
	}
}

function fillTypes()
{
	if($("#subcategories").val() == 0 && $("#categories").val() != 0)
	{
		return;
	}
	
	$("#types").append('<option data-index="-1" value="0" selected="selected"></option>');
	$("#types").append('<option data-index="-1" value="all">All</option>');
	for (var i = 0; i < types.length; i++)
	{
		$("#types").append('<option data-index="' +i+'" value="'+types[i].ID+'">'+types[i].Type+'</option>');
	}
	$(".types").show();
}

function fillResources()
{
	var category = $("#categories").val();
	var subcategory = $("#subcategories").val();
	var type = $("#types").val();
	
	if(subcategory == 0 && type == 0)
		return;
	else if (type == 0 || type == null)
		return;

	console.log(category);
	console.log(subcategory);
	console.log(type);
	
	loadResources(category, subcategory, type);
}

$(document).ready(function() {
	loadCategories();
	loadTypes();
	$(".subcategories").hide();
	$(".types").hide();
});

$(document).ajaxStop(function () {
	// Display all loaded resources
	var table = $(".resources-table");
	
	if(resources.length != 0)
		console.log(resources);
	
	if($("#categories").is(":empty")) 
		fillCategories();
	
	$("#categories").change(function() {
		console.log("Category changed");
				
		$("#subcategories").empty();
		$(".subcategories").hide();
		$("#types").empty();
		$(".types").hide();
		
		if($("#categories").val() == 0)
			return;
		
		fillSubcategories();
		fillTypes();
		fillResources();
	});
	
	$("#subcategories").change(function() {
		console.log("Subcategory changed");
		
		$("#types").empty();
		$(".types").hide();
		
		if($("#subcategories").val() == 0)
			return;
		fillTypes();
		fillResources();
	});
	
	$("#types").one('change', function () {
		console.log("Type changed");
		
		if($("#types").val() == 0)
			return;
		fillResources();
	});
});