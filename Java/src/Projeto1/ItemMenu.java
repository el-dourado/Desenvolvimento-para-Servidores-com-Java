package Projeto1;

public class ItemMenu {
    private String nome;
    private double preco;

    public ItemMenu(String nome, double preco) {
        this.nome = nome;
        this.preco = preco;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public double getPreco() {
        return preco;
    }

    public void setPreco(double preco) {
        if (preco >= 0) {
            this.preco = preco;
        } else {
            System.out.println("Erro: O preço não pode ser negativo.");
        }
    }

    public void exibirDetalhes() {
        System.out.println("Nome: " + this.nome);
        System.out.println(String.format("Preço: R$ %.2f", this.preco));
    }
}
