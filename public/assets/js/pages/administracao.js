var id_usuario = '';
var id_grupo = '';

$(document).ready(function() {
	console.log(' -> init administracao.js');
});


$(".tr_funcionalidade").click(async function(){
	var parms = { id_funcionalidade: $(this).attr("id")	};
	var dados_funcionalidade = await AJAX(parms, '/administracao/getFuncionalidade', 'POST');

	setDadosAlterarFuncionalidade(dados_funcionalidade);
	$("#btn_excluir_funcionalidade").attr('href', base_url+'/administracao/deleteFuncionalidade/'+parms.id_funcionalidade);
	$("#alterar_funcionalidade_modal").modal('show');
});

$(".tr_meta").click(async function(){
	var parms = { id_meta: $(this).attr("id") };
	console.log(parms);
	// var funcionalidades_usuario = await AJAX(parms, '/administracao/getTodasFuncionalidadesUsuario', 'POST');
	var dados_meta = await AJAX(parms, '/administracao/getMeta', 'POST');
	console.log(dados_meta);

	setDadosAlterarMeta(dados_meta);
	$("#btn_excluir_meta").attr('href', base_url+'/administracao/deleteMeta/'+parms.id_meta);
	$("#alterar_meta_modal").modal('show');
});


$(".btn_alter_user").click(async function(){
	var parms = { id_usuario: $(this).val() };
	var usuario = await AJAX(parms, '/administracao/getUsuario', 'POST');

	setDadosAlterarUsuario(usuario);
	$("#btn_excluir_usuario").attr('href', base_url+'/administracao/deleteUsuario/'+parms.id_usuario);
	$("#alterar_usuario_modal").modal('show');

});


$(".btn_alter_grupo").click(async function(){	
	var parms = { id_grupo: $(this).val() };
	var grupo_usuario = await AJAX(parms, '/administracao/getGrupo', 'POST');

	setDadosAlterarGrupo(grupo_usuario);
	$("#btn_excluir_grupo").attr('href', base_url+'/administracao/deleteGrupo/'+parms.id_grupo);
	$("#alterar_grupo_modal").modal('show');
});


$(".btn_permissoes_user").click(async function(){	
	$(".check_func").prop("checked", false).change();
	
	//VARIÁVEL GLOBAL
	id_usuario = $(this).val();

	var parms = { id_usuario : id_usuario };
	var funcionalidades_usuario = await AJAX(parms, '/administracao/getTodasFuncionalidadesUsuario', 'POST');

	for (var i = 0; i < funcionalidades_usuario.length; i++) {
		f = funcionalidades_usuario[i];
		$("#check_func_"+f.id_funcionalidade).prop("checked", true).change();
	}

	$("#permissoes_usuario_modal").modal('show');
});


$(".btn_funcionalidades_grupo").click(async function(){
	$(".check_func_grupo").prop("checked", false).change();
	//VARIÁVEL GLOBAL
	id_grupo = $(this).val();

	var parms = { id_grupo: id_grupo };	
	var funcionalidades_grupo = await AJAX(parms, '/administracao/getFuncionalidadesGrupo', 'POST');

	for (var i = 0; i < funcionalidades_grupo.length; i++) {
		f = funcionalidades_grupo[i];
		$("#check_func_grupo_"+f.id_funcionalidade).prop("checked", true).change();
	}

	$("#funcionalidades_grupo_modal").modal('show');
});


$(".check_func").click(async function(){
	let tipo_alteracao = 0;
	if($(this).is(':checked')){
		tipo_alteracao = 1;
	}

	var parms = {
		id_usuario: id_usuario,
		id_funcionalidade: $(this).val(),
		tipo_alteracao: tipo_alteracao
	};

	set_funcioanlidade_usuario = await AJAX(parms, '/administracao/setFuncionalidadeUsuario', 'POST');

});

$(".check_func_grupo").click(async function(){
	let tipo_alteracao = 0;
	if($(this).is(':checked')){
		tipo_alteracao = 1;
	}

	var parms = {
		id_grupo: id_grupo,
		id_funcionalidade: $(this).val(),
		tipo_alteracao: tipo_alteracao
	};

	set_funcioanlidade_grupo = await AJAX(parms, '/administracao/setFuncionalidadeGrupo', 'POST');

});


$("#form_novo_usuario").submit(function(event){
	senha_1 = $("#senha").val();
	senha_2 = $("#confirmaSenha").val();
	if(senha_1 != senha_2){		
		$("#senha").val('');
		$("#confirmaSenha").val('');
		$("#senha").focus();
		swal({
      		title: 'Senhas divergentes!',
      		icon: 'error',
      	});
      	event.preventDefault();
	}
});

$("#form_alterar_usuario").submit(function(event){
	senha_1 = $("#alter_senha").val();
	senha_2 = $("#alter_confirmaSenha").val();
	if(senha_1 != senha_2){		
		$("#alter_senha").val('');
		$("#alter_confirmaSenha").val('');
		$("#alter_senha").focus();
		swal({
      		title: 'Senhas divergentes!',
      		icon: 'error',
      	});
      	event.preventDefault();
	}
});


function setDadosAlterarUsuario(usuario){
	$("#alter_id_usuario").val(usuario.id_usuario);
	$("#alter_nome").val(usuario.nome);
	$("#alter_identificacao").val(usuario.identificacao);
	$("#alter_id_grupo").val(usuario.id_grupo);
	$("#alter_senha").val(usuario.senha);
	$("#alter_confirmaSenha").val(usuario.senha);
}

function setDadosAlterarFuncionalidade(func){
	console.log(func);
	let ativo = 1;
	if(!func.ativo) ativo = 0;
	$("#alter_id_funcionalidade").val(func.id_funcionalidade);
	$("#alter_id_funcionalidade_hidden").val(func.id_funcionalidade);
	$("#alter_nome").val(func.nome);
	$("#alter_link").val(func.link);
	$("#alter_associacao").val(func.associacao);
	$("#alter_tipo").val(func.tipo);
	$("#alter_icone").val(func.icone);
	$("#alter_nivel").val(func.nivel);
	$("#alter_ativoFuncionalidade").val(ativo);
}

function setDadosAlterarMeta(meta){
	console.log(meta);
	$("#alter_id_meta").val(meta.id_meta);
	$("#alter_meta").val(meta.meta);
	$("#alter_valor").val(meta.valor);
	$("#alter_id_grupo").val(meta.id_grupo);
}

function setDadosAlterarGrupo(grupo){
	console.log(grupo);
	let ativo = 1;
	if(!grupo.ativo) ativo = 0;
	$("#alter_Ctrl_Grupo_Usuarios").val(grupo.id_grupo);
	$("#alter_NomeGrupo").val(grupo.nome);
	$("#alter_Descricao").val(grupo.descricao);
	$("#alter_Administrador").val(grupo.identificacao_administrador);
	$("#alter_AtivoGrupo").val(ativo);
}

function redirectGerenciarUsuarios(id_grupo){
	$.redirect(base_url+'/administracao/gerenciarUsuarios',
	{
		id_grupo: id_grupo
	});	
}