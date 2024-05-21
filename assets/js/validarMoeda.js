function formatarMoeda() {
  var elemento = document.getElementById('valorAluguel');
  var valor = elemento.value;
  valor = valor + '';
  valor = parseInt(valor.replace(/[^\d]+/g, ''));
  // Aqui você pode formatar o valor como desejar
  // Por exemplo, adicionar R$ e separador de milhar
  elemento.value = valor.toLocaleString("pt-BR");
}