<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SeedsDefaultZendTable extends Seeder
{

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create(config('app.faker_locale'));

		DB::table('zend_perfis')->insert(array(
		    array('idperfil' => 2, 'descricao' => 'Usuário'),
            array('idperfil' => 90, 'descricao' => 'Administrador'),
            array('idperfil' => 99, 'descricao' => 'gazetamarista')
        ));

		DB::table('zend_usuarios')->insert(array(
		    array('idusuario' => 3, 'idperfil' => 99, 'nome' => 'Administrador gazetamarista', 'email' => 'admin@gazetamarista.com.br', 'login' => 'master', 'senha' => '90151c93f8f632206ec22298163da2e7' , 'chave' => null, 'sendmail' => null),
            array('idusuario' => 4, 'idperfil' => 2, 'nome' => 'User', 'email' => 'usuario@gazetamarista.com.br', 'login' => 'user', 'senha' => '202cb962ac59075b964b07152d234b70' , 'chave' => null, 'sendmail' => null),
            array('idusuario' => 5, 'idperfil' => 90, 'nome' => 'Sync Aero', 'email' => 'sync@sync.com.br', 'login' => 'sync', 'senha' => 'bb2fd8069f1c5ed1622ae6f960957cff' , 'chave' => null, 'sendmail' => null),
            array('idusuario' => 6, 'idperfil' => 90, 'nome' => 'Marketing', 'email' => 'marketing@gazetamarista.com.br', 'login' => 'marketing', 'senha' => '4297f44b13955235245b2497399d7a93' , 'chave' => null, 'sendmail' => null)
        ));

		DB::table('zend_menu_categorias')->insert(array(
		    array('idcategoria' => 1, 'icone' => 'mdi-view-dashboard', 'descricao' => 'Administração', 'ordenacao' => 1),
            array('idcategoria' => 2, 'icone' => 'mdi-home-city-outline', 'descricao' => 'Institucional', 'ordenacao' => 2),
            array('idcategoria' => 3, 'icone' => 'mdi-file-document-box-search-outline', 'descricao' => 'Consultas', 'ordenacao' => 4),
            array('idcategoria' => 4, 'icone' => 'mdi-file-document', 'descricao' => 'Loja Virtual', 'ordenacao' => 3)
        ));

		DB::table('zend_menu_itens')->insert(array(
		    array('iditem' => 1,	'idperfil' => 99, 'idcategoria' =>	1, 'descricao' =>	'Menu | Categorias',	'modulo' => 'admin', 'controlador' =>	'menuscategorias', 'acao' =>	'list'),
            array('iditem' => 2,	'idperfil' => 99, 'idcategoria' =>	1, 'descricao' =>	'Menu | Itens',	'modulo' => 'admin', 'controlador' =>	'menusitens', 'acao' =>	'list'),
            array('iditem' => 3,	'idperfil' => 90, 'idcategoria' =>	1, 'descricao' =>	'Perfil de Usuários',	'modulo' => 'admin', 'controlador' =>	'perfis', 'acao' =>	'list'),
            array('iditem' => 4,	'idperfil' => 90, 'idcategoria' =>	1, 'descricao' =>	'Usuários',	'modulo' => 'admin', 'controlador' =>	'usuarios', 'acao' =>	'list'),
            array('iditem' => 5,	'idperfil' => 2, 'idcategoria' =>	1, 'descricao' =>	'Trocar Senha',	'modulo' => 'admin', 'controlador' =>	'usuarios', 'acao' =>	'trocarsenha'),
            array('iditem' => 6,	'idperfil' => 90, 'idcategoria' =>	1, 'descricao' =>	'Configurações', 'modulo' =>	'admin', 'controlador' =>	'configuracoes', 'acao' =>	'form', 'parametros' => '/idconfiguracao/1'),
            array('iditem' => 7,	'idperfil' => 99, 'idcategoria' =>	1, 'descricao' =>	'Logs admin','modulo' => 'admin', 'controlador' =>	'logs', 'acao' =>	'list'),
            array('iditem' => 8,	'idperfil' => 2, 'idcategoria' =>	3, 'descricao' =>	'Contatos',	'modulo' => 'admin', 'controlador' =>	'contatos', 'acao' =>	'list'),
            array('iditem' => 9,	'idperfil' => 2, 'idcategoria' =>	3, 'descricao' =>	'E-mails',	'modulo' => 'admin', 'controlador' =>	'emails', 'acao' =>	'list'),
            array('iditem' => 10,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Bases',	'modulo' => 'admin', 'controlador' =>	'bases', 'acao' =>	'list'),
            array('iditem' => 11,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Notícias',	'modulo' => 'admin', 'controlador' =>	'blogs', 'acao' =>	'list'),
            array('iditem' => 12,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Serviços',	'modulo' => 'admin', 'controlador' =>	'servicos', 'acao' =>	'list'),
            array('iditem' => 13,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Sobre | DNA',	'modulo' => 'admin', 'controlador' =>	'dna', 'acao' =>	'list'),
            array('iditem' => 14,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Banners',	'modulo' => 'admin', 'controlador' =>	'banners', 'acao' =>	'list'),
            array('iditem' => 15,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Aviões',	'modulo' => 'admin', 'controlador' =>	'avioes', 'acao' =>	'list'),
            array('iditem' => 16,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Sobre',	'modulo' => 'admin', 'controlador' =>	'sobre', 'acao' =>	'form',	'parametros' => '/idsobre/1'),
            array('iditem' => 17,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Aviões | Detalhe',	'modulo' => 'admin', 'controlador' =>	'aviaodetalhes', 'acao' =>	'list'),
            array('iditem' => 18,	'idperfil' => 2, 'idcategoria' =>	2, 'descricao' =>	'Serviços | Itens',	'modulo' => 'admin', 'controlador' =>	'servicoitens', 'acao' =>	'list')
        ));

		DB::table('zend_logs')->insert(array(
		    array(
		        'idlog' => 1, 'idusuario' => 3, 'nomeusuario' => 'Administrador gazetamarista (master)', 'modulo' => 'admin', 'tabela' => 'zend_contatos',
                'json_data_antes' => '{"idcontato":"1","assunto":"Dúvida","nome":"gazetamarista","email":"teste@gazetamarista.com.br"}', 'json_data' => null,
                'acao_executada' => 'DELETE', 'browser_sistema' => '"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36"', 'data_execucao' => '2022-05-20 11:12:17', 'ip' => '187.18.107.86'
            ),
            array(
		        'idlog' => 2, 'idusuario' => 3, 'nomeusuario' => 'Administrador gazetamarista (master)', 'modulo' => 'admin', 'tabela' => 'zend_usuarios',
                'json_data_antes' => null, 'json_data' => '{"idusuario":1,"nome":"Marketing","email":"teste@gazetamarista.com.br","login":"marketing","senha":"4297f44b13955235245b2497399d7a93","idperfil":"90"}',
                'acao_executada' => 'INSERT', 'browser_sistema' => '"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36"', 'data_execucao' => '2022-05-23 09:42:56', 'ip' => '187.18.107.86'
            )
        ));

		DB::table('zend_erros')->insert(array(
		    array(
		        'iderro' => 1, 'data_execucao' => '2022-05-23 15:08:45', 'mensagem' => 'Invalid controller specified (quem-somos)', 'parametros' => '{"controller":"quem-somos","action":"index","module":"default"}',
                'browser_sistema' => '"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36"', 'idusuario' => null, 'trace' => '#0 C:\Wamp.NET\sites\gazetamarista.blog\library\Zend\Controller\Front.php(954): Zend_Controller_Dispatcher_Standard', 'ip' => '127.0.0.1'
            ),
            array(
		        'iderro' => 2, 'data_execucao' => '2022-05-24 09:14:30', 'mensagem' => 'Invalid controller specified (contatos)', 'parametros' => '{"controller":"contatos","action":"index","module":"default"}',
                'browser_sistema' => '"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36"', 'idusuario' => null, 'trace' => '#0 C:\Wamp.NET\sites\gazetamarista.blog\library\Zend\Controller\Front.php(1254): Zend_Controller_Dispatcher_Standard', 'ip' => '127.0.0.1'
            )
        ));

		DB::table('zend_cookies')->insert(array(
		    array('idcookie' => 1, 'ip' => '123.546.78', 'data' => '2022-05-23 09:42:56'),
            array('idcookie' => 2, 'ip' => '123.546.78', 'data' => '2022-05-24 15:50:12'),
            array('idcookie' => 3, 'ip' => '123.546.78', 'data' => '2022-05-25 11:03:25')
        ));

		DB::table('zend_configuracoes')->insert(array(
		    array(
		        'idconfiguracao' => 1,
                'nome_site' => 'Sync Aero',
                'email_padrao' => 'projetos@gazetamarista.com.br',
                'email_contato' => 'projetos@gazetamarista.com.br',
                'email_trabalhe' => 'projetos@gazetamarista.com.br',
                'facebook' => 'http://facebook.com/sync',
                'instagram' => 'http://instagram.com/sync',
                'linkedin' => 'http://linkedin.com/sync',
                'whatsapp' => '01999987654',
                'email_tela_contato' => 'sync@sync.com.br',
                'email_internacional' => 'sync@sync.com.br',
                'recaptcha_key' => '6LdpIMceAAAAAMci4BrlBwzI23pKNmpktLKC_bTK',
                'recaptcha_secret' => '6LdpIMceAAAAAPxF7iAW_TfDQot_8y0U1-aUMzTX',
                'politica_cookie_texto' => '<h2>1. O que são Cookies?</h2>',
                'politica_cookie_texto_en' => '<h2>1. What are Cookies?</h2>',
                'politica_cookie_texto_es' => '<h2>1. ¿Qué son las cookies?</h2>'
            )
        ));

	}
}