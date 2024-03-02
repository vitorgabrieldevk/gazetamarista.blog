<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <base href="{$basePath}/">
    <meta charset="UTF-8">
    {$this->headTitle()}
    {$this->headMeta()}

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1,  user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">

    {$this->headLink()}

    <link rel="shortcut icon" type="image/png" href="common/default/images/logos/32x32.png">
    <link rel="apple-touch-icon-precomposed" href="common/default/images/logos/57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="common/default/images/logos/76x76.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="common/default/images/logos/120x120.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="common/default/images/logos/152x152.png">
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="common/default/images/logos/180x180.png">

    <meta name="application-name" content="">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="common/default/images/logos/180x180.png">
    <meta name="msapplication-config" content="none">

    <script>
        var _GLOBALS = window._GLOBALS = {
            basePath: '{$basePath}',
            currentModule: '{$currentModule}',
            currentController: '{$currentController}',
            currentAction: '{$currentAction}',
            recaptcha_key: '{$_configuracao->recaptcha_key}'
        };
    </script>

    <!-- Compartilhamento -->
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="{$_configuracao->nome_site|escape}">
    <meta property="og:type" content="{($og_arr['titulo']) ? 'article': 'website'}">
    {if !empty($og_arr['url'])}
        <meta property="og:url" content="{$og_arr['url']|escape}">
    {else}
        <meta property="og:url" content="{current_url()}">
    {/if}
    {if !empty($og_arr['titulo'])}
        <meta property="og:title" content="{$og_arr['titulo']|escape}">
    {else}
        <meta property="og:title" content="{strip_tags($this->headTitle())}">
    {/if}
    {if !empty($og_arr['descricao'])}
        <meta property="og:description" content="{$og_arr['descricao']|escape}">
    {else}
        <meta property="og:description" content="{strip_tags($this->headMeta()->getValue('description')->content)}">
    {/if}
    {if !empty($og_arr['imagem'])}
        <meta property="og:image" content="{$og_arr['imagem']|escape}">
    {else}
        <meta property="og:image" content="{$basePath}/common/default/images/logos/opengraph.jpg">
    {/if}
    {if $application_env == 'production'}
        <!-- Código final head -->
        {$_configuracao->codigo_final_head}
    {/if}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style type='text/css'>
        .embeddedServiceHelpButton .helpButton .uiButton {
            background-color: #005290;
            font-family: "Arial", sans-serif;
        }

        .embeddedServiceHelpButton .helpButton .uiButton:focus {
            outline: 1px solid #005290;
        }
    </style>

</head>

<body>
    {if $application_env == 'production'}
        <!-- Código início do body -->
        {$_configuracao->codigo_inicio_body}
    {/if}

    <!-- Topo -->
    {include file="default/geral/topo.tpl"}

    <!-- Conteúdo -->
    {$this->layout()->content}

    <!-- Rodapé -->
    {include file="default/geral/rodape.tpl"}

    <!-- Cookies -->
    {include file="default/geral/cookies.tpl"}

    <!-- Scripts iniciais -->
    {$this->headScript()}

    {if $application_env == 'production'}
        <!-- Código final do body -->
        {$_configuracao->codigo_final_body}
    {/if}

    <!-- Alerta padrão -->
    {if $success|default:"" != ""}
        <script type="text/javascript">
            Swal.fire({
                title: "Sucesso!",
                text: "{$success}",
                type: "success",
                showConfirmButton: false,
                timer: 3000,
                onOpen: () => {
                    Swal.showLoading()
                }
            });
        </script>
    {/if}
    {if $error|default:"" != ""}
        <script type="text/javascript">
            Swal.fire('Ops!', '{$error}', 'error');
        </script>
    {/if}
    {if $warning|default:"" != ""}
        <script type="text/javascript">
            Swal.fire('Ops!', '{$warning}', 'warning');
        </script>
    {/if}
</body>

</html>