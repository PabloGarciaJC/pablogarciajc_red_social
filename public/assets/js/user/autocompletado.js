
$("#search").autocomplete({
  source: baseUrl + "search",
  minLength: 1,
  select: function (event, ui) {
    // var url = "{{ route('usuarioBuscador.perfil', ['perfil' => 'temp']) }}";
    var url = baseUrl + "usuario/" + 'temp';
    url = url.replace('temp', ui.item.value);
    location.href = url;
  }
}).data('ui-autocomplete')._renderItem = function (ul, item) {
  return $("<li class='ui-autocomplete-row'></li>")
    .data("item.autocomplete", item)
    .append(item.label)
    .appendTo(ul);
};








