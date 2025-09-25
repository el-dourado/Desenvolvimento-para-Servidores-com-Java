public class Restaurante {

    public static void main(String[] args) {

        System.out.println("--- Pedido 1: Prato ---");
        Prato p1 = new Prato("Feijoada Completa", 55.90, "Feijão preto, carnes de porco, arroz, couve e farofa.");

        p1.exibirDetalhes();

        System.out.println("\n--- Pedido 2: Bebida ---");
        Bebida b1 = new Bebida("Suco de Laranja Natural", 8.50, 500);

        b1.exibirDetalhes();

        System.out.println("\n-----------------------------------------\n");

        System.out.println("--- Demonstração do Encapsulamento ---");
        System.out.println("Preço antigo da Feijoada: R$ " + p1.getPreco());
        p1.setPreco(59.90); // alterando o preço
        System.out.println("Novo preço da Feijoada: R$ " + p1.getPreco());
        System.out.println("\n--- Demonstração da Sobrecarga ---");
        System.out.println(String.format("Preço do suco: R$ %.2f", b1.getPreco()));
    }
}