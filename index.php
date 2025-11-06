<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Rifas Automáticas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    
    <div class="main-container">
        <h1>Gerador de Rifas Automáticas</h1>
        
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="campanha">Nome da Campanha / Título da Rifa:</label>
                    <input type="text" id="campanha" name="campanha" required 
                           value="<?php echo isset($_POST['campanha']) ? htmlspecialchars($_POST['campanha']) : ''; ?>"
                           placeholder="Ex: Rifa Beneficente da Escola">
                </div>

                <div class="form-group">
                    <label for="premio">Prêmio(s) da Rifa:</label>
                    <textarea id="premio" name="premio" required placeholder="Ex: 1º Prêmio: Smartphone Samsung | 2º Prêmio: Cesta de Natal"><?php echo isset($_POST['premio']) ? htmlspecialchars($_POST['premio']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="valor">Valor da Rifa (R$):</label>
                    <input type="text" id="valor" name="valor" required 
                           value="<?php echo isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : ''; ?>"
                           placeholder="Ex: 5,00">
                </div>

                <div class="form-group">
                    <label for="data">Data do Sorteio:</label>
                    <input type="text" id="data" name="data" required 
                           value="<?php echo isset($_POST['data']) ? htmlspecialchars($_POST['data']) : date('d/m/Y', strtotime('+30 days')); ?>"
                           placeholder="Ex: 10/11/2025">
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade de Bilhetes:</label>
                    <input type="number" id="quantidade" name="quantidade" min="1" max="500" required 
                           value="<?php echo isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '50'; ?>">
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Gerar Bilhetes</button>
                </div>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $campanha = htmlspecialchars($_POST['campanha']);
            $premio = htmlspecialchars($_POST['premio']);
            $valor = htmlspecialchars($_POST['valor']);
            $data = htmlspecialchars($_POST['data']);
            $quantidade = intval($_POST['quantidade']);
            
            if ($quantidade > 0 && $quantidade <= 500) {
                // Exibir informações da rifa
                echo '<div class="info-rifa">';
                echo '<h3>Informações da Rifa</h3>';
                echo '<p><strong>Campanha:</strong> ' . $campanha . '</p>';
                echo '<p><strong>Prêmio(s):</strong> ' . $premio . '</p>';
                echo '<p><strong>Valor:</strong> R$ ' . $valor . ' | <strong>Data do Sorteio:</strong> ' . $data . ' | <strong>Total de Bilhetes:</strong> ' . $quantidade . '</p>';
                echo '</div>';
                
                // Botão de impressão
                echo '<div class="actions">';
                echo '<a href="javascript:window.print()" class="btn btn-print">🖨️ Imprimir Bilhetes</a>';
                echo '</div>';
                
                // Gerar bilhetes
                echo '<div class="rifas-container">';
                
                for ($i = 1; $i <= $quantidade; $i++) {
                    $numero_formatado = str_pad($i, 3, "0", STR_PAD_LEFT);
                    
                    echo '<div class="container">';
                    
                    // Canhoto
                    echo '<div class="canhoto">';
                    echo '<div class="linha-canhoto">';
                    echo '<p><strong>Nome:</strong> </p>';
                    echo '</div>';
                    echo '<div class="linha-canhoto">';
                    echo '<p><strong>Telefone:</strong></p>';
                    echo '</div>';
                    echo '<div class="linha-canhoto">';
                    echo '<p><strong>Endereço:</strong></p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<p><br><strong>Nº:</strong> ' . $numero_formatado . '</p>';
                    echo '</div>';
                    echo '</div>';
                    
                    // Bilhete
                    echo '<div class="bilhete">';
                    echo '<div class="titulo-rifa">' . $campanha . '</div>';
                    echo '<div class="numero-bilhete">Nº ' . $numero_formatado . '</div>';
                    echo '<div class="premio-rifa"><strong>Prêmio:</strong> ' . $premio . '</div>';
                    echo '<div class="valor-rifa"><strong>Valor:</strong> R$ ' . $valor . '</div>';
                    echo '<div class="data-rifa"><strong>Data do Sorteio:</strong> ' . $data . '</div>';
                    echo '</div>';
                    
                    echo '</div>';
                }
                
                echo '</div>';
                
                // Botão de impressão no final
                echo '<div class="actions no-print">';
                echo '<a href="javascript:window.print()" class="btn btn-print">Imprimir Bilhetes</a>';
                echo '</div>';
            } else {
                echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0;">';
                echo 'Quantidade de bilhetes inválida! Escolha um número entre 1 e 500.';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>