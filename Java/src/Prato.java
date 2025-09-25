public class Prato extends ItemMenu {
    private String descricao;


    public Prato(String nome, double preco, String descricao) {
        super(nome, preco);
        this.descricao = descricao;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }


    @Override
    public void exibirDetalhes() {
        super.exibirDetalhes();

        System.out.println("Descrição: " + this.descricao);
    }
}