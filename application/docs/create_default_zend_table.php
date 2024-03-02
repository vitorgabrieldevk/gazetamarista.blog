<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultZendTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('zend_perfis', function (Blueprint $table) {
		    $table->bigInteger('idperfil');
		    $table->string('descricao');
		});

		Schema::create('zend_usuarios', function (Blueprint $table) {
		    $table->bigIncrements('idusuario');
		    $table->unsignedBigInteger('idperfil');
            $table->string('nome');
            $table->string('email');
            $table->string('login', 45);
            $table->string('senha', 32)->nullable();
            $table->string('chave', 32)->nullable();
            $table->dateTime('sendmail')->nullable();

		    $table->foreign('idperfil')->references('idperfil')->on('zend_perfis')->onDelete('cascade');
		});

		Schema::create('zend_menu_categorias', function (Blueprint $table) {
		    $table->bigIncrements('idcategoria');
		    $table->string('icone');
            $table->string('descricao', 50);
            $table->bigInteger('ordenacao')->default(1)->nullable();
		});

		Schema::create('zend_menu_itens', function (Blueprint $table) {
		    $table->bigIncrements('iditem');
		    $table->unsignedBigInteger('idperfil');
            $table->unsignedBigInteger('idcategoria');
            $table->string('descricao', 50);
            $table->string('modulo', 50);
            $table->string('controlador', 50);
            $table->string('acao', 50);
            $table->string('parametros', 50)->nullable();

            $table->foreign('idperfil')->references('idperfil')->on('zend_perfis')->onUpdate('restrict')->onDelete('restrict');
		    $table->foreign('idcategoria')->references('idcategoria')->on('zend_categorias')->onUpdate('restrict')->onDelete('restrict');
		});

		Schema::create('zend_logs', function (Blueprint $table) {
		    $table->bigIncrements('idlog');
		    $table->unsignedBigInteger('idusuario');
            $table->string('nomeusuario');
            $table->string('modulo', 50);
            $table->string('tabela', 50);
            $table->text('json_data_antes')->nullable();
            $table->text('json_data')->nullable();
            $table->string('acao_executada', 20);
            $table->string('browser_sistema', 255);
            $table->dateTime('data_execucao');
            $table->string('ip', 30)->nullable();

            $table->foreign('idusuario')->references('idusuario')->on('zend_usuarios')->onUpdate('restrict')->onDelete('restrict');
		});

		Schema::create('zend_erros', function (Blueprint $table) {
		    $table->bigIncrements('iderro');
            $table->dateTime('data_execucao');
            $table->text('mensagem');
            $table->string('parametros', 50);
            $table->string('browser_sistema', 255);
		    $table->unsignedBigInteger('idusuario')->nullable();
            $table->text('trace')->nullable();
            $table->string('ip', 30)->nullable();

		    $table->foreign('idusuario')->references('idusuario')->on('zend_usuarios')->onUpdate('restrict')->onDelete('restrict');
		});

		Schema::create('zend_cookies', function (Blueprint $table) {
		    $table->bigIncrements('idcookie');
		    $table->string('ip', 30);
		    $table->dateTime('data');
		});

		Schema::create('zend_configuracoes', function (Blueprint $table) {
		    $table->bigIncrements('idconfiguracao');
		    $table->string('nome_site', 255);
            $table->string('email_padrao', 255)->nullable();
            $table->string('email_contato', 255)->nullable();
            $table->string('email_trabalhe', 255)->nullable();
            $table->string('google_play', 255)->nullable();
            $table->string('apple_store', 255)->nullable();
            $table->text('texto_bloco_app_home')->nullable();
            $table->text('texto_bloco_app_home_en')->nullable();
            $table->text('texto_bloco_app_home_es')->nullable();
            $table->string('link_area_cliente', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('frota_banner_desktop', 255)->nullable();
            $table->string('frota_banner_mobile', 255)->nullable();
            $table->string('frota_texto_tela', 255)->nullable();
            $table->string('frota_texto_tela_en', 255)->nullable();
            $table->string('frota_texto_tela_es', 255)->nullable();
            $table->text('endereco')->nullable();
            $table->string('link_maps', 255)->nullable();
            $table->string('email_tela_contato', 255)->nullable();
            $table->string('telefone_escritorio_geral', 255)->nullable();
            $table->string('telefone_vendas', 255)->nullable();
            $table->string('telefone_setor_operacoes', 255)->nullable();
            $table->string('telefone_internacional', 255)->nullable();
            $table->string('email_internacional', 255)->nullable();
            $table->string('telefone_rampa', 255)->nullable();
            $table->string('recaptcha_key', 255)->nullable();
            $table->string('recaptcha_secret', 255)->nullable();
            $table->string('share_tag', 255)->nullable();
            $table->text('codigo_final_head')->nullable();
            $table->text('codigo_inicio_body')->nullable();
            $table->text('codigo_final_body')->nullable();
            $table->text('politica_cookie_texto')->nullable();
            $table->text('politica_cookie_texto_en')->nullable();
            $table->text('politica_cookie_texto_es')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('zend_menu_itens');
		Schema::dropIfExists('zend_menu_categorias');
		Schema::dropIfExists('zend_perfis');
		Schema::dropIfExists('zend_logs');
		Schema::dropIfExists('zend_erros');
		Schema::dropIfExists('zend_usuarios');
		Schema::dropIfExists('zend_cookies');
		Schema::dropIfExists('zend_configuracoes');
	}
}