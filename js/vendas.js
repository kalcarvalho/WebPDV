/* Classe Item */
var Item = function() {
	var produto = '';
	var itens = 0;
	
	this.inicializa = function() {
		this.itens = 0;
	}
	
	this.updateItens = function() {
		this.itens++;
	}
}
/* Classe Carrinho */
var Carrinho = function() {
	var codigo = 0;
	var referencia = '';
	var descricao = '';
	var preco = 0.00;
	var qtde = 0;
	var subtotal = 0.00;
}