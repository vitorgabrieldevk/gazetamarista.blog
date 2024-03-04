<main id="site-corpo" class="home">
    <section class="bloco-categorias-topo">
        <div class="slides" {literal} data-slide='{"autoplay":{"delay":500000}, "watchOverflow":false, "spaceBetween":25, "slidesPerView": 1, "breakpoints":{"1500":{"slidesPerView":7, "slidesPerGroup":7}, "1200":{"slidesPerView":6, "slidesPerGroup":6}, "900":{"slidesPerView":3, "slidesPerGroup":3}, "460":{"slidesPerView":2, "slidesPerGroup":2}  }}' {/literal}>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <h3 class="title-slide currentPage">Últimas Noticias</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Acontece na escola</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Londrina na visão</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Atualidades</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Fala Marista</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Quadrinhos</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Recomendados</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Tecnologia</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Trabalho</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Tecnologia</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Recomendados</h3>
                    </div>
                    <div class="swiper-slide">
                        <h3 class="title-slide">Quadrinhos</h3>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div> 
        </div>
        <hr>    
    </section>

    <section class="bloco-noticiasPrincipais">
        <div class="left">
            <div class="tipo">
                <h3 class="text-tipo">Recomendados</h3>
            </div>
            <div class="info-noticia">
                <div><span class="autor">Maria Eduarda Mendes</span> - <span class="data">13 de dezembro de 2023</span></div>
                <h1 class="title-noticia">10ª EDIÇÃO DO MEET UP NO MARISTA ESCOLA SOCIAL IR. ACÁCIO FOI COM O EMPREENDEDOR MARLON PASCOAL</h1>
            </div>
            <img class="item-noticia-image" src="{$path}/common/default/images/index/placeholder.png" alt="Imagem da Noticia Principal">
        </div>
    </section>

    <section class="containerMain">

        <br><br><br><br>

        <main class="container">
          <section class="articles">
              {foreach from=$noticias item="item"}
                <article class="card-new-one">
                  <div class="article-wrapper">
                    <figure>
                      <img src="{$dominio}/common/uploads/blog/{$item->imagem}" alt="Image News" />
                    </figure>
                    <div class="article-body">
                      <h2 class="title-new-card-one">{$item->titulo}</h2>
                      <p>{$item->texto}</p>
                      <a href="newspaper/feed/edition-3/a-geracao-mais-defasada-no-mundo-da-leitura.html" class="read-more text-decoration-underline">
                        Continuar Lendo <span class="sr-only">about this is some title</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </a>
                    </div>
                  </div>
                </article>
              {/foreach}
          </section> 

          <hr>
    
    
    
            <!-- --------------------------------------------------- | Recomendados |---------------------------------------- -->
    
            <div class="row g-5">
                <div class="col-md-8">
    
                <article class="blog-post p-4">
                    <h2 class="display-5 link-body-emphasis mb-1">Quem Somos <i class="bi bi-question-circle"></i></h2>
                    <p class="blog-post-meta">Marista Escola Social Irmão Acácio - <a href="https://marista.org.br/marcelino-champagnat/">Marcelino Champagnat</a></p>
    
                    <p><b>Bem-vindo ao nosso jornal!</b> Somos uma equipe dedicada de alunos e professores comprometidos em trazer notícias <b>relevantes</b> e envolventes para a comunidade escolar. Nosso jornal é uma plataforma criada para informar, inspirar e conectar os membros da nossa escola.</p>
                    <p>Acreditamos que informação é poder e que uma comunidade bem informada é essencial para o crescimento e o desenvolvimento de todos.</p>
                    <p>É com grande entusiasmo que embarcamos nessa jornada de compartilhar conhecimento e histórias inspiradoras com vocês, nossa comunidade escolar. Estamos comprometidos em trazer notícias que abordem não apenas os eventos e atividades da escola, mas também temas relevantes que afetam nossa sociedade e o mundo ao nosso redor. Queremos encorajar o diálogo, a reflexão e a participação ativa de todos, pois acreditamos que juntos podemos construir um ambiente escolar ainda mais enriquecedor e inclusivo. Agradecemos por nos acompanharem nesta jornada e esperamos continuar a inspirar e conectar cada um de vocês por meio das palavras e das histórias que compartilhamos.</p>
    
                    <hr>
    
                    <p>Estamos ansiosos para continuar trazendo notícias e histórias emocionantes para vocês. Juntos, construiremos uma comunidade escolar informada, inspirada e unida. Até a próxima edição!</p>
                </article>
    
                <article class="blog-post p-4">
                    <h2 class="display-5 link-body-emphasis mb-1">Novas Atualizações</h2>
                    <p class="blog-post-meta">Jul 04, 2023 Por <a href="#">Vitor Gabriel</a> e <a href="#">Nathan Fabricio</a></p>
    
                    <p></p>
                    <ul>
                    <li>Sistema de Categorias <i class="bi bi-tags-fill"></i></li>
                    <li>Suporte <i class="bi bi-headset"></i></li>
                    <li>Como usar <i class="bi bi-info-circle-fill"></i></li>
                    <li>Importante <i class="bi bi-exclamation-lg"></i></li>
                    <li>Campanhas de Doações <i class="bi bi-bag-heart-fill"></i></li>
                    </ul>
                </article>
    
                <nav class="blog-pagination" aria-label="Pagination">
                    <a class="btn btn-outline-primary rounded-pill" href="https://maristaescolassociais.org.br/escola/marista-escola-social-ir-acacio/">Marista - Venha Conhecer</a>
                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">2023</a>
                </nav>
    
                </div>
    
                <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-body-tertiary rounded">
                        <h4 class="fst-italic">Sobre</h4>
                        <p class="mb-0">Nosso objetivo é informar, inspirar e conectar. <i class="bi bi-chat-left-heart-fill"></i></p>
                    </div>
    
                    <div>
                    <h4 class="fst-italic">Ajude quem precisa <i class="bi bi-bag-heart-fill"></i></h4>
                    <ul class="list-unstyled">
                        <li>
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis border-top" href="https://maristaescolassociais.org.br/imposto-solidario/">
                            <div class="col-lg-8">
                            <h6 class="mb-0">Imposto Solidário - Marista</h6>
                            <small class="text-body-secondary">Jul 04, 2023</small>
                            </div>
                        </a>
                        </li>
                        <li>
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis border-top" href="https://doacoes.gov.br/">
                            <div class="col-lg-8">
                            <h6 class="mb-0">Doações gov.br</h6>
                            <small class="text-body-secondary">Jul 04, 2023</small>
                            </div>
                        </a>
                        </li>
                        <li>
                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis border-top" href="https://www.exercitodoacoes.org.br/">
                            <div class="col-lg-8">
                            <h6 class="mb-0">Exército de Doações</h6>
                            <small class="text-body-secondary">Jul 04, 2023</small>
                            </div>
                        </a>
                        </li>
                    </ul>
                    </div>
    
                    <div class="p-4">
                    <h4 class="fst-italic">Importante</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a target="_blank" href="https://maristaescolassociais.org.br/doe-agora/">Como Doar?</a></li>
                        <li><a target="_blank" href="https://conteudo.colegiosmaristas.com.br/solidariedade-internacional-terremoto">Instituto Marista</a></li>
                        <li><a target="_blank" href="https://maristaescolassociais.org.br/conheca-o-blog/">Blog Marista</a></li>
                        <li><a target="_blank" href="https://maristaescolassociais.org.br/conheca-nossos-projetos/">Projetos</a></li>
                        <li><a target="_blank" href="https://sites.google.com/view/marista-ir-acacio">Ensino Médio Marista</a></li>
                        <li><a target="_blank" href="https://sites.google.com/view/marista-ir-acacio/estrutura_1?authuser=0">Estrutura Escolar</a></li>
                        <li><a target="_blank" href="https://sites.google.com/view/marista-ir-acacio/grade-curricular?authuser=0">Grade Curricular Ir. Acácio</a></li>
                        <li><a target="_blank" href="https://sites.google.com/view/marista-ir-acacio/contato?authuser=0">Onde nos encontrar?</a></li>
                        <li><a target="_blank" href="https://linktr.ee/maristairacacio">Mais informações</a></li>
                        <li><a target="_blank" href="https://linktr.ee/maristairacacio">Vagas de Emprego - Marista</a></li>
                        <li><a target="_blank" href="https://api.whatsapp.com/send/?phone=5543996090504&text&type=phone_number&app_absent=0">WhatsApp Ir. Acácio</a></li>
                        <li><a target="_blank" href="https://sites.google.com/view/marista-ir-acacio/documenta%C3%A7%C3%A3o-necess%C3%A1ria?authuser=0">Documentação Necessária</a></li>
                    </ol>
                    </div>
    
                    <div class="p-4">
                    <h4 class="fst-italic">Outros</h4>
                    <ol class="list-unstyled">
                        <li><a target="_blank" href="https://github.com/MaristaIrAcacio/GazetaMarista"><i class="bi bi-github"></i> GitHub</a></li>
                        <li><a target="_blank" href="https://www.instagram.com/maristairacacio/"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li><a target="_blank" href="https://www.facebook.com/maristairacacio"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/company/marista-ir-acácio/"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                    </ol>
                    </div>
                </div>
                </div>
            </div>
        </main>

    </section>

</main>

<div class="slide">