package Projeto1;

public class Bebida extends ItemMenu {
    private int volumeMl;

    public Bebida(String nome, double preco, int volumeMl) {
        super(nome, preco);
        this.volumeMl = volumeMl;
    }

    public int getVolumeMl() {
        return volumeMl;
    }

    public void setVolumeMl(int volumeMl) {
        this.volumeMl = volumeMl;
    }

    @Override
    public void exibirDetalhes() {
        super.exibirDetalhes();
        System.out.println("Volume: " + this.volumeMl + "ml");
    }
}