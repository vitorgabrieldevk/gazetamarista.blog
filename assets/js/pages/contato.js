$(document).ready(() => {
	let $site_corpo = $('#site-corpo');

	if( $site_corpo.hasClass('main-contato') )
	{
		$site_corpo.find('.bloco-formulario form .campo-assunto').on('change', (e) => {
			const obj  = $(e.currentTarget);
			const form = obj.closest('form');

            if (obj.find('option:selected').attr('data-mostrar-upload') !== undefined)
                {
                    form.find('.arquivo-upload').removeClass('uk-hidden');
                } else {
                    form.find('.arquivo-upload').addClass('uk-hidden');
                }
		}).change();
	}
});
