<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.objetivos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-objetivos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.objetivos',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;
	
	$objetivos = Painel::selectAll('tb_site.objetivos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Objetivos Cadastrados</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Objetivos</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php
			foreach ($objetivos as $key => $value) {
		?>
		<div></div>
		<tr>
			<td><?php echo  $value['objetivos']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-objetivos?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-objetivos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-objetivos?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-objetivos?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.objetivos')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-objetivos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-objetivos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->