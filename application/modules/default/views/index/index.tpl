<main id="site-corpo" class="home">

    {if $categorias|count > 0}
        <section class="bloco-categorias-topo">
            <div class="slides" {literal} data-slide='{"autoplay":{"delay":500000}, "watchOverflow":false, "spaceBetween":25, "slidesPerView": 1, "breakpoints":{"1500":{"slidesPerView":7, "slidesPerGroup":7}, "1200":{"slidesPerView":6, "slidesPerGroup":6}, "900":{"slidesPerView":3, "slidesPerGroup":3}, "460":{"slidesPerView":2, "slidesPerGroup":2}  }}' {/literal}>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <h3 class="title-slide currentPage">Página Inicial</h3>
                        </div>
                        {foreach from=$categorias item="item"}
                            <div class="swiper-slide">
                                <h3 class="title-slide currentPage">{$item->nome}</h3>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div class="swiper-pagination"></div> 
            </div>
            <hr>    
        </section>
    {/if}

   

    <section class="containerMain">
            <div class="row g-5">
                <div class="col-md-8">
                    {if $sobre }
                        <article class="blog-post p-4">
                            <h2 class="display-5 link-body-emphasis mb-1">{$sobre[0]->titulo}</h2>
                            <p>{$sobre[0]->texto1}</p>
                            <hr>
                            <p>{$sobre[0]->texto2}</p>
                        </article>
                    {/if}
        
                    <!-- <article class="blog-post p-4">
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
                    </article> -->
        
                    <nav class="blog-pagination" aria-label="Pagination">
                        <a class="btn btn-outline-primary rounded-pill" href="https://maristaescolassociais.org.br/escola/marista-escola-social-ir-acacio/">{$sobre[0]->tag}</a>
                        <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">2024</a>
                    </nav>
        
                    </div>
        
                    <div class="col-md-4">
                    <div class="position-sticky" style="top: 2rem;">
                        <div class="p-4 mb-3 bg-body-tertiary rounded">
                            <h4 class="fst-italic">Sobre</h4>
                            <p class="mb-0">{$sobre[0]->objetivo} <i class="bi bi-chat-left-heart-fill"></i></p>
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