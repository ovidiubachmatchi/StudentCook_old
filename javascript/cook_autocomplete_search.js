$( function() {
    var availableTags = [
      "Rice",
      "Egg",
      "Chicken",
      "Pork",
      "Beef",
      "Cheese",
      "Orange",
      "Turkey",
      "Onion",
      "Corn",
      "Bacon",
      "Mushrooms",
      "Apple"
    ];
    $( "#ingredient" ).autocomplete({
      source: availableTags,
      select: function (e, ui) {
        put_ingredient(ui.item.value);
    },
    });
    
  } );
  