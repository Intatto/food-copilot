$(document).ready(function () {

    $('#addDish').click(function () {
      var row = `
        <tr>
          <th class="head_cell" contenteditable="true">Piatto</th>
          <td class="preparation_cell" contenteditable="true">Preparazione</td>
          <td class="td_button_prep"><button type="button" class="addPreparation">+</button></td>
        </tr>`;
      $('.table_body').append(row);
    });
  
    $(document).on('blur', '.head_cell', function () {
      var piatto = $(this).text();
      $.ajax({
        url: 'aggiungi_piatto.php',
        type: 'POST',
        data: { piatto: piatto },
        success: function (response) {
          console.log(response);
        }
      });
    });
  
    $(document).on('blur', '.preparation_cell', function () {
      var preparazione = $(this).text();
      var piatto = $(this).siblings('.head_cell').text();
      $.ajax({
        url: 'aggiungi_preparazione.php',
        type: 'POST',
        data: { preparazione: preparazione, piatto: piatto },
        success: function (response) {
          console.log(response);
        }
      });
    });
  
    $(document).on('click', '.addPreparation', function () {
      var row = `
        <tr>
          <td class="ingredient_preparation" contenteditable="true">Preparazione</td>
          <td class="ingredient_cell" contenteditable="true">Ingrediente</td>
          <td><input type="text" class="quantity_input" placeholder="Quantità"></td>
          <td><button type="button" class="addIngredient">+</button></td>
        </tr>`;
      $('.ingredient_table .table_body').append(row);
    });
  
    $(document).on('click', '.addIngredient', function () {
      var preparazione = $(this).parent().siblings('.ingredient_preparation').text();
      var ingrediente = $(this).parent().siblings('.ingredient_cell').text();
      var quantita = $(this).parent().siblings('.quantity_input').val();
      $.ajax({
        url: 'aggiungi_ingrediente.php',
        type: 'POST',
        data: { preparazione: preparazione, ingrediente: ingrediente, quantita: quantita },
        success: function (response) {
          console.log(response);
        }
      });
    });
  
  });
  