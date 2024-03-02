<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SeedsInstitucionalZendTable extends Seeder
{

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create(config('app.faker_locale'));

		DB::table('zend_banners')->insert(array(
		    'idbanner' => 1,
            'titulo' => 'Banner teste',
            'titulo_en' => 'Bann test',
            'titulo_es' => 'Banns tester',
            'frase1' => 'Aviação brasileira',
            'frase1_en' => 'Brazilian aviation',
            'frase1_es' => 'Aviación brasileña',
            'frase2' => 'Sync',
            'frase2_en' => 'Syncs',
            'frase2_es' => 'Synco',
            'imagem_desktop' => 'e3be12e71c5054319786b79232d62697.jpg',
            'imagem_mobile' => '1125b7e3571440e8bb2245105d1100a4.jpg'
        ));

		DB::table('zend_blogs')->insert(
		    array(
                'idblog' => 1,
                'titulo' => 'Notícia de aviação',
                'titulo_en' => 'Aviation news',
                'titulo_es' => 'Noticias de aviación',
                'imagem' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sapien eget vulputate aliquet.',
                'texto_en' => 'Vivamus dictum sapien eget vulputate aliquet.',
                'texto_es' => 'Hola pellentesque sem ante.',
                'data' => '2022-05-15'
            ),
            array(
                'idblog' => 2,
                'titulo' => 'Notícia teste de avião',
                'titulo_en' => 'Test aviation news',
                'titulo_es' => 'Teste noticias de aviación',
                'imagem' => 'be9e3f90d17c2b91c375a25995402ecf.jpg',
                'texto' => 'Proin nec risus et enim commodo eleifend sed id arcu. Aenean pellentesque sem ante, et feugiat purus mattis quis.',
                'texto_en' => 'Aenean pellentesque sem ante, et feugiat purus mattis quis.',
                'texto_es' => 'Hola pellentesque sem ante.',
                'data' => '2022-06-02'
            )
        );

		DB::table('zend_contatos')->insert(
		    array(
		        'idcontato' => 1,
                'assunto' => 'Contato',
                'nome' => 'José Abreu',
                'email' => 'testes@gazetamarista.com.br',
                'telefone' => '(43) 3337-3800',
                'cidade' => 'Londrina',
                'estado' => 'PR',
                'mensagem' => 'Teste de envio de contato framework.',
                'data' => '2021-03-29 15:35:15',
                'ip' => '189.32.58.212'
            ),
            array(
		        'idcontato' => 2,
                'assunto' => 'Contato',
                'nome' => 'Arnaldo Gonçalves',
                'email' => 'gazetamarista@gazetamarista.com.br',
                'telefone' => '(43) 3337-3800',
                'cidade' => 'Londrina',
                'estado' => 'PR',
                'mensagem' => 'Teste de envio de contato framework.',
                'data' => '2021-04-01 09:10:52',
                'ip' => '184.65.81.123'
            )
        );

		DB::table('zend_emails')->insert(
		    array(
		        'idemail' => 1,
                'email' => 'testes@gazetamarista.com.br',
                'nome' => null,
                'data' => '2021-12-02 11:17:00',
                'ip' => '123.168.10.12'
            ),
            array(
		        'idemail' => 2,
                'email' => 'contato@gazetamarista.com.br',
                'nome' => null,
                'data' => '2021-12-06 20:42:15',
                'ip' => '124.124.61.20'
            )
        );

		DB::table('zend_sobre')->insert(
		    array(
		        'idsobre' => 1,
                'banner_home_desktop' => 'banner-sobre-home.png',
                'banner_home_mobile' => 'banner-sobre-home-mobile.png',
                'banner_desktop' => 'head-image.png',
                'banner_mobile' => 'head-image.png',
                'frase_banner' => 'Sync Aero',
                'frase_banner_en' => 'Syncs',
                'frase_banner_es' => 'Synco',
                'texto1' => 'Sync Aero',
                'texto1_en' => 'Syncs Aero',
                'texto1_es' => 'Sync Aeros'
            )
        );

		DB::table('zend_dna')->insert(
		    array(
                'iddna' => 1,
                'titulo' => 'Aviação',
                'titulo_en' => 'Aviation',
                'titulo_es' => 'Aviación',
                'texto' => 'Compõe o nosso leque de produtos e serviços.',
                'texto_en' => 'Compõe o nosso leque de produtos e serviços.',
                'texto_es' => 'Compõe o nosso leque de produtos e serviços.',
                'ordenacao' => 1
            ),
            array(
                'iddna' => 2,
                'titulo' => 'Eficiência',
                'titulo_en' => 'Efficiency',
                'titulo_es' => 'Eficiencia',
                'texto' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'texto_en' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'texto_es' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'ordenacao' => 2
            ),
            array(
                'iddna' => 3,
                'titulo' => 'Economia',
                'titulo_en' => 'Economy',
                'titulo_es' => 'Economía',
                'texto' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'texto_en' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'texto_es' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'ordenacao' => 3
            ),
            array(
                'iddna' => 4,
                'titulo' => 'Responsabilidade',
                'titulo_en' => 'Responsibility',
                'titulo_es' => 'Responsabilidad',
                'texto' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'texto_en' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'texto_es' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'ordenacao' => 4
            )
        );

		DB::table('zend_servicos')->insert(
		    array(
                'idservico' => 1,
                'titulo' => 'Gestão de aeronaves',
                'titulo_en' => 'Gestão de aeronaves',
                'titulo_es' => 'Gestão de aeronaves',
                'imagem' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'banner_desktop' => 'e3be12e71c5054319786b79232d62697.jpg',
                'banner_mobile' => '8e6d02a281fea652094bb14ba572f730.jpg',
                'texto1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'texto1_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'texto1_es' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'travar_menu' => 0,
                'ordenacao' => 1
            ),
            array(
                'idservico' => 2,
                'titulo' => 'Propriedade compartilhada',
                'titulo_en' => 'Propriedade compartilhada',
                'titulo_es' => 'Propriedade compartilhada',
                'imagem' => 'be9e3f90d17c2b91c375a25995402ecf.jpg',
                'banner_desktop' => 'e3be12e71c5054319786b79232d62697.jpg',
                'banner_mobile' => '8e6d02a281fea652094bb14ba572f730.jpg',
                'texto1' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'texto1_en' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'texto1_es' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'travar_menu' => 0,
                'ordenacao' => 2
            ),
            array(
                'idservico' => 3,
                'titulo' => 'Taxi aéreo',
                'titulo_en' => 'Taxi aéreo',
                'titulo_es' => 'Taxi aéreo',
                'imagem' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'banner_desktop' => 'bg-jet-wide02.png',
                'banner_mobile' => 'bg-jet02.png',
                'texto1' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'texto1_en' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'texto1_es' => 'Maecenas ultrices nisl non iaculis tristique. Lorem ipsum dolor sit amet.',
                'travar_menu' => 1,
                'ordenacao' => 3
            )
        );

		DB::table('zend_servicoitens')->insert(
		    array(
                'idservicoitem' => 1,
                'idservico' => 1,
                'item' => 'Economia',
                'item_en' => 'Economy',
                'item_es' => 'Economía',
                'img' => '46465465465465sssss.jpg',
                'descricao' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'descricao_en' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'descricao_es' => 'Com a aviação executiva você otimiza seu tempo, dedicando-se ao que realmente importa.',
                'ordenacao' => 1
            ),
            array(
                'idservicoitem' => 2,
                'idservico' => 1,
                'item' => 'Responsabilidade',
                'item_en' => 'Responsibility',
                'item_es' => 'Responsabilidad',
                'img' => 'be9e3f90d17c2b91c375a25995402ecf.jpg',
                'descricao' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'descricao_en' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'descricao_es' => 'Responsabilidade perante a sociedade e nossos clientes norteiam todos nossos passos e objetivos.',
                'ordenacao' => 2
            ),
            array(
                'idservicoitem' => 3,
                'idservico' => 2,
                'item' => 'Eficiência',
                'item_en' => 'Efficiency',
                'item_es' => 'Eficiencia',
                'img' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'descricao' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'descricao_en' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'descricao_es' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'ordenacao' => 1
            ),
            array(
                'idservicoitem' => 4,
                'idservico' => 3,
                'item' => 'Eficiência',
                'item_en' => 'Efficiency',
                'item_es' => 'Eficiencia',
                'img' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'descricao' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'descricao_en' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'descricao_es' => 'Prestamos serviços para suprir suas necessidades profissionais e pessoais.',
                'ordenacao' => 1
            )
        );

		DB::table('zend_bases')->insert(
		    array(
                'idbase' => 1,
                'titulo' => 'SBCA | Cascavel',
                'titulo_en' => 'SBCA | Cascavel',
                'titulo_es' => 'SBCA | Cascavel',
                'imagem' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'area_construida' => '2.500 m2',
                'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_es' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.'
            )
        );

		DB::table('zend_baseitens')->insert(
		    array(
                'idbaseitem' => 1,
                'idbase' => 1,
                'tipo' => 'facilidade',
                'item' => 'Pátio próprio',
                'item_en' => 'Pátio próprio',
                'item_es' => 'Pátio próprio',
                'ordenacao' => 1
            ),
            array(
                'idbaseitem' => 2,
                'idbase' => 1,
                'tipo' => 'facilidade',
                'item' => 'Sala de pilotos',
                'item_en' => 'Sala de pilotos',
                'item_es' => 'Sala de pilotos',
                'ordenacao' => 2
            ),
            array(
                'idbaseitem' => 3,
                'idbase' => 1,
                'tipo' => 'facilidade',
                'item' => 'Recepção',
                'item_en' => 'Recepção',
                'item_es' => 'Recepção',
                'ordenacao' => 3
            ),
            array(
                'idbaseitem' => 4,
                'idbase' => 1,
                'tipo' => 'serviço',
                'item' => 'Hangaragem',
                'item_en' => 'Hangaragem',
                'item_es' => 'Hangaragem',
                'ordenacao' => 1
            ),
            array(
                'idbaseitem' => 5,
                'idbase' => 1,
                'tipo' => 'serviço',
                'item' => 'Limpeza e Polimento',
                'item_en' => 'Limpeza e Polimento',
                'item_es' => 'Limpeza e Polimento',
                'ordenacao' => 2
            )
        );

		DB::table('zend_avioes')->insert(
		    array(
                'idaviao' => 1,
                'titulo' => 'Aeronave Num. 01',
                'titulo_en' => 'Aeronave Num. 01',
                'titulo_es' => 'Aeronave Num. 01',
                'imagem' => '46465465465465989898.jpg',
                'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_es' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'banner_desktop' => 'ban3be12e71c5054319786b79232d62697.jpg',
                'frase_centro' => 'Aviação e segurança',
                'frase_centro_en' => 'Aviação e segurança',
                'frase_centro_es' => 'Aviação e segurança',
                'ordenacao' => 1
            ),
            array(
                'idaviao' => 2,
                'titulo' => 'Aeronave Num. 02',
                'titulo_en' => 'Aeronave Num. 02',
                'titulo_es' => 'Aeronave Num. 02',
                'imagem' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'descricao' => 'Consect as borem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_en' => 'Consect as borem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'descricao_es' => 'Consect as borem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices nisl non iaculis tristique.',
                'banner_desktop' => 'ban3be12e71c5054319786b79232d62697.jpg',
                'frase_centro' => 'Aviação e segurança',
                'frase_centro_en' => 'Aviação e segurança',
                'frase_centro_es' => 'Aviação e segurança',
                'ordenacao' => 2
            )
        );

		DB::table('zend_aviaoitens')->insert(
		    array(
                'idaviaoitem' => 1,
                'idaviao' => 1,
                'tipo' => 'vantagens',
                'item' => 'Cabine espaçosa',
                'item_en' => 'Cabine espaçosa',
                'item_es' => 'Cabine espaçosa',
                'conteudo' => '',
                'conteudo_en' => '',
                'conteudo_es' => '',
                'ordenacao' => 1
            ),
            array(
                'idaviaoitem' => 2,
                'idaviao' => 1,
                'tipo' => 'vantagens',
                'item' => 'Design moderno',
                'item_en' => 'Design moderno',
                'item_es' => 'Design moderno',
                'conteudo' => '',
                'conteudo_en' => '',
                'conteudo_es' => '',
                'ordenacao' => 2
            ),
            array(
                'idaviaoitem' => 3,
                'idaviao' => 1,
                'tipo' => 'vantagens',
                'item' => 'Segurança comprovada',
                'item_en' => 'Segurança comprovada',
                'item_es' => 'Segurança comprovada',
                'conteudo' => '',
                'conteudo_en' => '',
                'conteudo_es' => '',
                'ordenacao' => 3
            ),
            array(
                'idaviaoitem' => 4,
                'idaviao' => 1,
                'tipo' => 'performance',
                'item' => 'Velocidade máxima',
                'item_en' => 'Velocidade máxima',
                'item_es' => 'Velocidade máxima',
                'conteudo' => '537 km/h',
                'conteudo_en' => '537 km/h',
                'conteudo_es' => '537 km/h',
                'ordenacao' => 1
            ),
            array(
                'idaviaoitem' => 5,
                'idaviao' => 1,
                'tipo' => 'performance',
                'item' => 'Alcance médio',
                'item_en' => 'Alcance médio',
                'item_es' => 'Alcance médio',
                'conteudo' => '1.980 NM',
                'conteudo_en' => '1.980 NM',
                'conteudo_es' => '1.980 NM',
                'ordenacao' => 2
            ),
            array(
                'idaviaoitem' => 6,
                'idaviao' => 2,
                'tipo' => 'vantagens',
                'item' => 'Baixo custo e eficiente',
                'item_en' => 'Baixo custo e eficiente',
                'item_es' => 'Baixo custo e eficiente',
                'conteudo' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'conteudo_en' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'conteudo_es' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'ordenacao' => 1
            ),
            array(
                'idaviaoitem' => 7,
                'idaviao' => 2,
                'tipo' => 'vantagens',
                'item' => 'Cabine grande',
                'item_en' => 'Cabine grande',
                'item_es' => 'Cabine grande',
                'conteudo' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'conteudo_en' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'conteudo_es' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'ordenacao' => 2
            ),
            array(
                'idaviaoitem' => 8,
                'idaviao' => 2,
                'tipo' => 'performance',
                'item' => 'Velocidade máxima',
                'item_en' => 'Velocidade máxima',
                'item_es' => 'Velocidade máxima',
                'conteudo' => '620 km/h',
                'conteudo_en' => '620 km/h',
                'conteudo_es' => '620 km/h',
                'ordenacao' => 1
            )
        );

		DB::table('zend_aviao_detalhes')->insert(
		    array(
                'idaviaodetalhe' => 1,
                'idaviao' => 1,
                'detalhe' => 'Características',
                'detalhe_en' => 'Características',
                'detalhe_es' => 'Características',
                'img' => '0gf08hjuf0j98gf09j8gf.jpg',
                'texto' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'texto_en' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'texto_es' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'ordenacao' => 1
            ),
            array(
                'idaviaodetalhe' => 2,
                'idaviao' => 1,
                'detalhe' => 'Conforto',
                'detalhe_en' => 'Conforto',
                'detalhe_es' => 'Conforto',
                'img' => 'as8df7as98dg7fas89df7as9df.jpg',
                'texto' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'texto_en' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'texto_es' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'ordenacao' => 2
            ),
            array(
                'idaviaodetalhe' => 3,
                'idaviao' => 2,
                'detalhe' => 'Segurança',
                'detalhe_en' => 'Segurança',
                'detalhe_es' => 'Segurança',
                'img' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'texto' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'texto_en' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'texto_es' => 'Ut enim tellus, placerat eget purus nec, pretium blandit massa.',
                'ordenacao' => 1
            ),
            array(
                'idaviaodetalhe' => 4,
                'idaviao' => 2,
                'detalhe' => 'Confiança',
                'detalhe_en' => 'Confiança',
                'detalhe_es' => 'Confiança',
                'img' => '3e3e3092e1a9af04104793c75599ed6e.jpg',
                'texto' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'texto_en' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'texto_es' => 'Sodales nisi id justo lacinia eleifend vitae convallis est, efficitur lacinia orci. Morbi ac erat semper, suscipit eros sit amet, vehicula dui.',
                'ordenacao' => 2
            )
        );

	}
}