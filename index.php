<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- library css js -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <title>API</title>
</head>
<body>
    <section id="table-prods">
        <div class="main-container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="row row-cols-2" id="header-title">
                            <div class="col-sm-6">
                                <h1 class="title">Loja <b>WooCommerce</b></h1>
                            </div>
                            <!-- buttons -->
                            <div class="col-sm-6">
                                <a href="#addProdModal" class="btn btn-outline-success" id="span-success" data-toggle="modal">
                                    <i class="material-icons">&#xe148;</i>
                                    Novo Produto
                                </a>
                                <a href="#deleteSelectProdModal" class="btn btn-outline-danger" id="span-danger" data-toggle="modal" onclick="$(this).getProdsDel();">
                                    <i class="material-icons">&#xe15d;</i>
                                    Excluir
                                </a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="selectAll">
                                            <label for="selectAll"></label>
                                        </span>
                                    </th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Preço Promocional</th>
                                    <th>Link</th>
                                    <th>Destaque</th>
                                    <th></th> <!-- Actions -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP Insert data Table -->
                                <?php
                                $data = $woocommerce->get('products');
                                $qtdP = count($data);
                                for ($i = 0; $i < $qtdP; $i++) {
                                    $prod = $data[$i];
                                    echo '<tr class="row' . $i . '">';
                                    echo '<td class="col-check">
                                                <span  class="custom-checkbox">
                                                    <input type="checkbox" id="checkbox' . $i . '" name="option[]" value="'. $prod->id .'">
                                                    <label for="checkbox1"></label>
                                                </span>
                                            </td>';
                                    echo "<td>" . $prod->name . "</td>";
                                    echo "<td >" . $prod->description . "</td>";
                                    echo "<td class='col-hidden'>" . $prod->short_description . "</td>";
                                    echo "<td style='width: 95px;'>R$ " . $prod->regular_price . "</td>";
                                    if (empty($prod->sale_price)) {
                                        echo "<td style='width: 150px;'>R$ - </td>";
                                    } else {
                                        echo "<td style='width: 175px;'>R$ " . $prod->sale_price . "</td>";
                                    }
                                    echo "<td><a href='" . $prod->permalink . "' target='_blank'><small>" . $prod->permalink . "</small></a></td>";
                                    if ($prod->featured == true) {
                                        echo "<td style='text-align: center; cursor: pointer;'><i class='material-icons featured' data-toggle='tooltip' title='Em Destaque'>&#xe838;</i></td>";
                                    } else {
                                        echo "<td style='text-align: center; cursor: pointer;'><i class='material-icons no-featured' data-toggle='tooltip' title='Não está em Destaque'>&#xe83a;</i></td>";
                                    }
                                ?>
                                    <td class="actions">
                                        <a href="#editProdModal" class="edit" data-toggle="modal" onclick="getDataEdit(<?php echo $i ?>, <?php echo $prod->id ?>)">
                                            <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                                        </a>
                                        <a href="#deleteProdModal" class="delete" data-toggle="modal" onclick="getDataDel('<?php echo $prod->name ?>', <?php echo $prod->id ?>)">
                                            <i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i>
                                        </a>
                                    </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <!-- --------------------- -->                                
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="clearfix">
                            <?php
                            echo '<div class="hint-text">Produtos: <b>' . $qtdP . '</b></div>';
                            // if ($qtdP <= 5) {
                            //     echo '<div class="hint-text">Mostrando <b>'. $qtdP .'</b> produtos</div>';
                            // }
                            // else {
                            //     echo '<div class="hint-text">Mostrando <b>5</b> de <b>'. $qtdP .'</b> produtos</div>';                               
                            // }                                
                            ?>
                            <!-- <ul class="pagination">
                                <li class="page-item"><a href="#">Anterior</a></li>
                                <li class="page-item"><a herf="#" class="page-link">1</a></li>
                                <li class="page-item"><a herf="#" class="page-link">2</a></li>
                                <li class="page-item active"><a herf="#" class="page-link">3</a></li>
                                <li class="page-item"><a herf="#" class="page-link">4</a></li>
                                <li class="page-item"><a herf="#" class="page-link">5</a></li>
                                <li class="page-item"><a herf="#" class="page-link">Próximo</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Modal Html -->
    <div id="addProdModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <form method="post" action="repository/add.php" onsubmit="$('#loadAdd').css('visibility', 'visible');">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" arial-hidden="true">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" requerid>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <label for="descripton">Descrição</label>
                            <textarea class="form-control" id="descripton" name="descripton" rows="3"></textarea>
                        </div>
                        <!-- ----------- -->
                        <!-- Description -->
                        <div class="form-group">
                            <label for="short_descripton">Breve Descrição</label>
                            <textarea class="form-control" id="short_descripton" name="short_descripton" rows="3"></textarea>
                        </div>
                        <!-- ----------- -->
                        <div class="form-group">
                            <label for="price">Preço</label>
                            <span class="input-prefix">
                                <br /><span class="symbol-currency">R$&nbsp;</span>   
                                <input type="text" class="form-control currency" id="price" name="price" requerid>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="price-sale">Preço Promocional</label>
                            <span class="input-prefix">
                                <br /><span class="symbol-currency">R$&nbsp;</span>   
                                <input type="text" class="form-control currency" id="price-sale" name="price-sale" requerid>
                            </span>
                        </div>

                        <div class="form-check">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="featured" name="featured">
                                <label for="featured">Em Destaque?</label>
                            </span>
                        </div>
                        <div class="modal-footer">
                            <div id="loadAdd" style="visibility: hidden;" class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div>
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-success" name="add" value="Adicionar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editProdModal" class="modal fade">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content rounded">
                <form method="post" action="repository/edit.php" onsubmit="$('#loadEdit').css('visibility', 'visible');">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Id Prod -->
                        <div class="form-group">
                            <input type="hidden" id="prodId" name="prodId" value="0">
                        </div>
                        <!-- ----------- -->        
                        <div class="form-group">
                            <label for="nome_edit">Nome</label>
                            <input type="text" class="form-control" id="nome_edit" name="nome_edit" requerid>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <label for="descripton_edit">Descrição</label>
                            <textarea class="form-control" id="descripton_edit" name="descripton_edit" rows="3"></textarea>
                        </div>
                        <!-- ----------- -->
                        <!-- Breve Description -->
                        <div class="form-group">
                            <label for="short_descripton_edit">Breve Descrição</label>
                            <textarea class="form-control" id="short_descripton_edit" name="short_descripton_edit" rows="3"></textarea>
                        </div>
                        <!-- ----------- -->
                        <div class="form-group">
                            <label for="price_edit">Preço</label>
                            <span class="input-prefix">
                                <br /><span class="symbol-currency">R$&nbsp;</span>
                                <input type="text" class="form-control currency" id="price_edit" name="price_edit" requerid>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="price-sala_edit">Preço Promocional</label>
                            <span class="input-prefix">
                                <br /><span class="symbol-currency">R$&nbsp;</span> 
                                <input type="text" class="form-control currency" id="price-sale_edit" name="price-sala_edit" requerid>
                            </span>
                        </div>
                        <!-- ------------ -->
                        <div class="form-check">
                            <span class="custom-checkbox">                                
                                <input type="checkbox" id="featured_edit" name="featured_edit">
                                <label for="featured_edit">Em Destaque?</label>
                            </span>
                        </div>
                        <div class="modal-footer">
                            <div id="loadEdit" style="visibility: hidden;" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div>
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-info" name="edit" value="Salvar">
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
    <!-- Delete Modal HTML -->
    <div id="deleteProdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content rounded">
                <form method="post" action="repository/delete.php" onsubmit="$('#loadDel').css('visibility', 'visible');">
                    <div class="modal-header">
                        <h4 class="modal-title">Excluir Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir estes registros?</p>
                        <p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
                        <p id="nameProdDel"></p>
                        <input type="hidden" id="prodIdDel" name="prodIdDel" value="0">
                    </div>
                    <div class="modal-footer">
                        <div id="loadDel" style="visibility: hidden;" class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div>
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-danger" name="del" value="Deletar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Select Delete Modal HTML -->
    <div id="deleteSelectProdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content rounded">
                <form method="post" action="repository/delete_select.php" onsubmit="$('#loadSelectDel').css('visibility', 'visible');">
                    <div class="modal-header">
                        <h4 class="modal-title">Excluir Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir estes registros?</p>
                        <p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
                        <p id="namesProdDel"></p>
                        <input type="hidden" id="prodIdsDel" name="prodIdDel" value="0">
                    </div>
                    <div class="modal-footer">
                        <div id="loadSelectDel" style="visibility: hidden;" class="spinner-border text-danger" role="status">
                                <span class="sr-only">Loading...</span>
                        </div>
                        <div>
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-danger" name="del" value="Deletar">
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
                        

    <!-- Script connect external JS -->
    <script src="js/script.js"></script>
    <script src="js/getEdit.js"></script>
    <script src="js/getDel.js"></script>
    <script src="js/getSelectDel.js"></script>
</body>
</html>