<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionalZendTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zend_banners', function (Blueprint $table) {
		    $table->bigIncrements('idbanner');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->string('frase1')->nullable();
            $table->string('frase1_en')->nullable();
            $table->string('frase1_es')->nullable();
            $table->string('frase2')->nullable();
            $table->string('frase2_en')->nullable();
            $table->string('frase2_es')->nullable();
            $table->string('txt_botao', 30)->nullable();
            $table->string('txt_botao_en', 30)->nullable();
            $table->string('txt_botao_es', 30)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('link_en', 255)->nullable();
            $table->string('link_es', 255)->nullable();
            $table->boolean('link_novajanela')->default(0)->nullable();
            $table->string('imagem_desktop', 255)->nullable();
            $table->string('imagem_mobile', 255)->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();
		});

		Schema::create('zend_blogs', function (Blueprint $table) {
            $table->bigIncrements('idblog');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->string('imagem', 255)->nullable();
            $table->text('texto')->nullable();
            $table->text('texto_en')->nullable();
            $table->text('texto_es')->nullable();
            $table->string('autor')->nullable();
            $table->string('autor_en')->nullable();
            $table->string('autor_es')->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('tags_en', 255)->nullable();
            $table->string('tags_es', 255)->nullable();
            $table->date('data');
            $table->bigInteger('qtd_curtidas')->nullable();
            $table->bigInteger('qtd_naocurtidas')->nullable();
            $table->bigInteger('qtd_views')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_title_en', 255)->nullable();
            $table->string('meta_title_es', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_es')->nullable();
            $table->boolean('ativo')->default(1)->nullable();
        });

		Schema::create('zend_contatos', function (Blueprint $table) {
		    $table->bigInteger('idcontato');
		    $table->string('assunto', 255);
            $table->string('nome', 255);
            $table->string('email', 255);
            $table->string('telefone', 30)->nullable();
            $table->string('cidade', 150)->nullable();
            $table->string('estado', 80)->nullable();
            $table->text('mensagem')->nullable();
            $table->string('anexo', 255)->nullable();
            $table->dateTime('data')->nullable();
            $table->string('ip', 30)->nullable();
            $table->boolean('visualizado')->default(0)->nullable();
		});

		Schema::create('zend_emails', function (Blueprint $table) {
		    $table->bigInteger('idemail');
            $table->string('email', 255);
            $table->string('nome', 255)->nullable();
            $table->dateTime('data')->nullable();
            $table->string('ip', 30)->nullable();
		});

		Schema::create('zend_sobre', function (Blueprint $table) {
		    $table->bigInteger('idsobre');
		    $table->string('banner_home_desktop', 255)->nullable();
            $table->string('banner_home_mobile', 255)->nullable();
            $table->string('banner_desktop', 255)->nullable();
            $table->string('banner_mobile', 255)->nullable();
            $table->string('frase_banner', 150)->nullable();
            $table->string('frase_banner_en', 150)->nullable();
            $table->string('frase_banner_es', 150)->nullable();
            $table->text('texto1')->nullable();
            $table->text('texto1_en')->nullable();
            $table->text('texto1_es')->nullable();
            $table->text('texto2')->nullable();
            $table->text('texto2_en')->nullable();
            $table->text('texto2_es')->nullable();
            $table->text('historia_texto')->nullable();
            $table->text('historia_texto_en')->nullable();
            $table->text('historia_texto_es')->nullable();
            $table->string('imagem_texto', 255)->nullable();
            $table->string('frase_inauguracao', 255)->nullable();
            $table->string('frase_inauguracao_en', 255)->nullable();
            $table->string('frase_inauguracao_es', 255)->nullable();
            $table->text('texto_visao')->nullable();
            $table->text('texto_visao_en')->nullable();
            $table->text('texto_visao_es')->nullable();
            $table->text('texto_missao')->nullable();
            $table->text('texto_missao_en')->nullable();
            $table->text('texto_missao_es')->nullable();
            $table->text('texto_valores')->nullable();
            $table->text('texto_valores_en')->nullable();
            $table->text('texto_valores_es')->nullable();
            $table->string('comoatendemos_imagem', 255)->nullable();
            $table->string('comoatendemos_titulo_imagem', 255)->nullable();
            $table->string('comoatendemos_titulo_imagem_en', 255)->nullable();
            $table->string('comoatendemos_titulo_imagem_es', 255)->nullable();
            $table->text('comoatendemos_texto')->nullable();
            $table->text('comoatendemos_texto_en')->nullable();
            $table->text('comoatendemos_texto_es')->nullable();
		});

		Schema::create('zend_dna', function (Blueprint $table) {
		    $table->bigInteger('iddna');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->text('texto')->nullable();
            $table->text('texto_en')->nullable();
            $table->text('texto_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();
		});

		Schema::create('zend_servicos', function (Blueprint $table) {
		    $table->bigInteger('idservico');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->string('imagem', 255)->nullable();
            $table->string('banner_desktop', 255)->nullable();
            $table->string('banner_mobile', 255)->nullable();
            $table->text('texto1')->nullable();
            $table->text('texto1_en')->nullable();
            $table->text('texto1_es')->nullable();
            $table->text('texto2')->nullable();
            $table->text('texto2_en')->nullable();
            $table->text('texto2_es')->nullable();
            $table->boolean('travar_menu')->default(0)->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();
		});

		Schema::create('zend_servicoitens', function (Blueprint $table) {
		    $table->bigInteger('idservicoitem');
		    $table->unsignedBigInteger('idservico');
		    $table->string('item', 255);
            $table->string('item_en', 255)->nullable();
            $table->string('item_es', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->text('descricao_en')->nullable();
            $table->text('descricao_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();

            $table->foreign('idservico')->references('idservico')->on('zend_servicos')->onDelete('cascade');
		});

		Schema::create('zend_bases', function (Blueprint $table) {
		    $table->bigInteger('idbase');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->string('imagem', 255)->nullable();
            $table->string('area_construida', 50)->nullable();
            $table->text('descricao')->nullable();
            $table->text('descricao_en')->nullable();
            $table->text('descricao_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();
		});

		Schema::create('zend_baseitens', function (Blueprint $table) {
		    $table->bigInteger('idbaseitem');
		    $table->unsignedBigInteger('idbase');
		    $table->enum('tipo', ['facilidade','serviço']);
		    $table->string('item', 255);
            $table->string('item_en', 255)->nullable();
            $table->string('item_es', 255)->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();

            $table->foreign('idbase')->references('idbase')->on('zend_bases')->onDelete('cascade');
		});

		Schema::create('zend_avioes', function (Blueprint $table) {
		    $table->bigInteger('idaviao');
		    $table->string('titulo', 255);
            $table->string('titulo_en', 255)->nullable();
            $table->string('titulo_es', 255)->nullable();
            $table->string('imagem', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->text('descricao_en')->nullable();
            $table->text('descricao_es')->nullable();
		    $table->string('banner_desktop', 255);
		    $table->string('banner_mobile', 255);
		    $table->string('frase_centro', 255);
		    $table->string('frase_centro_en', 255);
		    $table->string('frase_centro_es', 255);
            $table->text('texto')->nullable();
            $table->text('texto_en')->nullable();
            $table->text('texto_es')->nullable();
            $table->text('texto2')->nullable();
            $table->text('texto2_en')->nullable();
            $table->text('texto2_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();
		});

		Schema::create('zend_aviaoitens', function (Blueprint $table) {
		    $table->bigInteger('idaviaoitem');
		    $table->unsignedBigInteger('idaviao');
		    $table->enum('tipo', ['vantagens','performance']);
		    $table->string('item', 255);
            $table->string('item_en', 255)->nullable();
            $table->string('item_es', 255)->nullable();
            $table->text('conteudo')->nullable();
            $table->text('conteudo_en')->nullable();
            $table->text('conteudo_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();

            $table->foreign('idaviao')->references('idaviao')->on('zend_avioes')->onDelete('cascade');
		});

		Schema::create('zend_aviao_detalhes', function (Blueprint $table) {
		    $table->bigInteger('idaviaodetalhe');
		    $table->unsignedBigInteger('idaviao');
		    $table->string('detalhe', 255);
            $table->string('detalhe_en', 255)->nullable();
            $table->string('detalhe_es', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->text('texto')->nullable();
            $table->text('texto_en')->nullable();
            $table->text('texto_es')->nullable();
            $table->bigInteger('ordenacao')->default(1)->nullable();
            $table->boolean('ativo')->default(1)->nullable();

            $table->foreign('idaviao')->references('idaviao')->on('zend_avioes')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('zend_banners');
		Schema::dropIfExists('zend_blogs');
		Schema::dropIfExists('zend_contatos');
		Schema::dropIfExists('zend_emails');
		Schema::dropIfExists('zend_sobre');
		Schema::dropIfExists('zend_dna');
		Schema::dropIfExists('zend_servicoitens');
		Schema::dropIfExists('zend_servicos');
		Schema::dropIfExists('zend_baseitens');
		Schema::dropIfExists('zend_bases');
		Schema::dropIfExists('zend_aviao_detalhes');
		Schema::dropIfExists('zend_aviaoitens');
		Schema::dropIfExists('zend_avioes');
	}
}