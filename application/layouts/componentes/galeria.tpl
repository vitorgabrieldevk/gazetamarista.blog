<div class="content" id="fotos">
    <div class="row">
        <input id="idgaleria" type="hidden" value="{$idgaleria}">

        <div class="small-12 medium-6 large-4 end columns">
            <div class="arquivo-upload-avancado" data-upload-url="{$this->url(['module'=>'admin', 'controller'=>$controller, 'action'=>'upload'], 'default', TRUE)}" data-campo-ref-name="fotos">
                <label for="fotos[]">Selecione uma ou mais imagens</label>
                <div class="arquivo_tmp">
                    <div class="solte-arquivos">Selecione ou solte aqui <span class="input-file-upload"></span></div>
                </div>
                <div class="arquivos-enviados"></div>
                <input type="file" name="fotos[]" id="fotos[]" multiple tabindex="-1" autocomplete="off" accept="image/png, image/jpeg">
            </div>
        </div>

        <div class="small-12 columns">
            <p><b>*</b> após enviar as imagens, clique em atualizar para salvar</p>
            <p><b>*</b> clique na imagem para ampliar</p>
            <p><b>*</b> clique e arraste para ordenar as imagens</p>
        </div>

        {if !$itens|count}
            <div class="small-12 columns no-photos">
                <p>(nenhuma imagem cadastrada)</p>
            </div>
        {/if}

        <div class="small-12 columns">
            <ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-6 photos" data-order-url="{$basePath}/admin/galerias/salvaordem/">
                {foreach from=$itens item=row}
                    {assign var="img_existe" value="common/uploads/galeria/"|cat:$row->imagem}
                    {if file_exists($img_existe) && !empty($row->imagem)}
                        {assign var="src_img" value=$this->url(['tipo'=>'galeria', 'crop'=>'1', 'largura'=>220, 'altura'=>220, 'imagem'=>$row->imagem], 'imagem', TRUE)}
                        <li id="{$row['idgaleriaitem']}">
                            <div class="panel">
                                <div class="row collapse">
                                    <div class="small-12 columns acoes-galeria">
                                        <a data-src="{$basePath}/admin/galerias/removeimage/idgaleria/{$idgaleria}/idgaleriaitem/{$row['idgaleriaitem']}/foto/{$row['imagem']}" class="btn-remove-image" title="Excluir">
                                            <span class="delete"></span>
                                        </a>
                                    </div>
                                    <div class="small-12 columns text-center imagem">
                                        <a href="{$this->url(['tipo'=>'galeria', 'crop'=>1, 'largura'=>220, 'altura'=>220, 'imagem'=>$row['imagem']], 'imagem', TRUE)}">
                                            <img src="{$src_img}" alt="">
                                        </a>
                                    </div>
                                    <div class="small-12 columns legenda">
                                        <label for="img_legenda_{$row['idgaleriaitem']}">Legenda</label>
                                        <input type="text" name="img_legenda" id="img_legenda_{$row['idgaleriaitem']}" value="{$row['legenda']}" class="varchar string legenda" data-iditem="{$row['idgaleriaitem']}" data-url="{$basePath}/admin/galerias/salvalegenda/">
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/if}
                {/foreach}
            </ul>
        </div>
    </div>
</div>