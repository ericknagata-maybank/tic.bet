<!doctype html>
<html class="html-app-{{ env('APP_NAME') }}" data-country="XXX" data-timezone="xxxxxx/xxxxxx" data-city="xxxxxx" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, user-scalable=no, shrink-to-fit=no">
	<title>Casa de Apostas Online | {{ env('APP_NAME') }}</title>
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="#0474cc">
	<meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}">
	<meta name="description" content="Aposte com confiança no melhor site de apostas esportivas. No {{ env('APP_NAME') }}, você encontra promoções exclusivas, análises profissionais e suporte premium 24 horas 7 dias por semana. Comece a ganhar hoje!">
	<meta name="og:title" content="Aposta Online | Jogos Incríveis e Saques Imediatos | {{ env('APP_NAME') }}">
	<meta name="og:site_name" content="Aposta Online | Jogos Incríveis e Saques Imediatos | {{ env('APP_NAME') }}">
	<meta name="og:type" content="website">
	<meta name="og:description" content="Aposte com confiança no melhor site de apostas esportivas. No {{ env('APP_NAME') }}, você encontra promoções exclusivas, análises profissionais e suporte premium 24 horas 7 dias por semana. Comece a ganhar hoje!">
	<meta name="build-version" content="multi-app">
	<link rel="icon" type="image/png" href="https://imagedelivery.net/BgH9d8bzsn4n0yijn4h7IQ/4aa3f036-8bfb-475c-a805-f7e52954f900/mobile">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}"> @php $custom = \Helper::getCustom() @endphp



<!-- Eventos fb -->
<!-- Código JavaScript para disparar eventos no clique -->
<script>
function addEventListeners(button) {
    const buttonText = button.textContent.trim();
    console.log('Button clicked:', buttonText);

    // Verificar o texto do botão e disparar o evento correto do Facebook Pixel
    if (buttonText === 'Criar Conta') {
        console.log('Disparando evento Registro');
        fbq('track', 'CompleteRegistration');
        fbq('track', 'Registro');

    }
    if (buttonText === 'Depositar') {
        console.log('Disparando evento Inicio deposito');
        fbq('track', 'Inicio deposito');
    }
    if (buttonText === 'Gerar PIX') {
        console.log('Disparando evento Gerar Pix');
        fbq('track', 'Gerar Pix');
    }
    if (buttonText.includes('Código copiado')) {
        console.log('Disparando evento Copiar pixqrcode');
        fbq('track', 'Copiar pixqrcode');
    }
    if (buttonText === 'Eu já paguei o PIX') {
        console.log('Disparando evento botao eu ja paguei o PIX');
        fbq('track', 'botao eu ja paguei o PIX');
    }
    if (buttonText === 'Sim, quero cancelar') {
        console.log('Disparando evento botao cancelar registro');
        fbq('track', 'botao cancelar registro');
    }
}

function observeDOMChanges() {
    const targetNode = document.body;
    const config = { childList: true, subtree: true };

    const callback = (mutationsList) => {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList') {
                const addedNodes = mutation.addedNodes;
                addedNodes.forEach(node => {
                    if (node.nodeType === 1) {
                        const buttons = node.querySelectorAll('button');
                        buttons.forEach(button => {
                            if (!button.dataset.listenerAdded) {
                                button.addEventListener('click', function() {
                                    addEventListeners(button);
                                });
                                button.dataset.listenerAdded = 'true'; // Marcando botão como listener adicionado
                            }
                        });
                    }
                });
            }
        }
    };

    const buttonObserver = new MutationObserver(callback);
    buttonObserver.observe(targetNode, config);
}

// Chama a função para iniciar a observação do DOM
document.addEventListener('DOMContentLoaded', () => {
    observeDOMChanges();

    // Adicionar ouvintes a botões existentes no carregamento inicial
    setTimeout(() => {
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            if (!button.dataset.listenerAdded) {
                button.addEventListener('click', function() {
                    addEventListeners(button);
                });
                button.dataset.listenerAdded = 'true'; 
            }
        });
    }, 1000);
});
</script>





	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ $custom->idPixelGoogle }}"></script>
	<style>
		body {
		    font-family: '' Roboto Condensed', sans-serif';
		}
		
		:root {
		    --ci-primary-color: {{ $custom['cc_topo_botao'] }}; /* topo, botão, e icone*/
		    --navtop-color-dark: {{ $custom['barra_logo'] }}; /* Barra do navegador logo*/
		    --ci-promotion-background-color: {{ $custom['icone_presente'] }}; /* icone presente*/
		    --sidebar-color-dark: {{ $custom['menu_lateral'] }} !important; /* Menu lateral*/
		    --ci-primary-opacity-color: {{ $custom['fundo_icone'] }};
		    --background-base: {{ $custom['cor_fundo'] }};
		    --ci-secundary-color: #0c0c0c;
		    --ci-gray-dark: #0c0c0c;
		    --ci-gray-light: #0c0c0c;
		    --ci-gray-medium: #0c0c0c;
		    --ci-gray-over: #0c0c0c;
		    --title-color: #0c0c0c;
		    --text-color: #0c0c0c;
		    --sub-text-color: #0c0c0c;
		    --placeholder-color: #0c0c0c;
		    --background-color: #0c0c0c;
		    --standard-color: #1C1E22;
		    --shadow-color: #111415;
		    --page-shadow: linear-gradient(to right, #111415, rgba(17, 20, 21, 0));
		    --autofill-color: #f5f6f7;
		    --yellow-color: #FFBF39;
		    --yellow-dark-color: #d7a026;
		    --border-radius: .25rem;
		    --tw-border-spacing-x: 0;
		    --tw-border-spacing-y: 0;
		    --tw-translate-x: 0;
		    --tw-translate-y: 0;
		    --tw-rotate: 0;
		    --tw-skew-x: 0;
		    --tw-skew-y: 0;
		    --tw-scale-x: 1;
		    --tw-scale-y: 1;
		    --tw-scroll-snap-strictness: proximity;
		    --tw-ring-offset-width: 0px;
		    --tw-ring-offset-color: #fff;
		    --tw-ring-color: rgba(59, 130, 246, .5);
		    --tw-ring-offset-shadow: 0 0 #0000;
		    --tw-ring-shadow: 0 0 #0000;
		    --tw-shadow: 0 0 #0000;
		    --tw-shadow-colored: 0 0 #0000;
		
		    --input-primary: #0c0c0c;
		    --input-primary-dark: #0c0c0c;
		
		    --carousel-banners: #1F1F1E;
		    --carousel-banners-dark: #1F1F1E;
		
		
		    --sidebar-color: #1F1F1E !important
		    --navtop-color #2C2B2B;
		
		
		    --side-menu #FF4C1E;
		    --side-menu-dark: #FF4C1E;
		
		    --footer-color #0A0A0A;
		    --footer-color-dark: #0A0A0A;
		
		    --card-color #0c0c0c;
		    --card-color-dark: #0c0c0c;
		    --ci-promotion-color: #FCFDFC;
		}
		
		.navtop-color {
		    background-color: #1F1F1E !important;
		}
		
		:is(.dark .navtop-color) {
		    background-color: #1F1F1E !important;
		}
		
		.bg-base {
		    background-color: #1F1F1E;
		}
		:is(.dark .bg-base) {
		    background-color: {{ $custom['cor_fundo'] }}; /* Cor de fundo do site*/
		    }
	</style> @if(!empty($custom['custom_css'])) <style>
		{
		    ! ! $custom['custom_css'] ! !
		}
	</style> @endif @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body color-theme="dark" class="text-gray-800 bg-base dark:text-gray-300 ">
	<div id="EclipeGaming"></div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
	<script>
		window.Livewire?.on('copiado', (texto) => {
		    navigator.clipboard.writeText(texto).then(() => {
		        Livewire.emit('copiado');
		    });
		});
		
		window._token = '{{ csrf_token() }}';
		if (localStorage.getItem('color-theme') === 'light') {
		    document.documentElement.classList.remove('dark')
		    document.documentElement.classList.add('light');
		} else {
		    document.documentElement.classList.remove('light')
		    document.documentElement.classList.add('dark')
		}
		const custom = {
		    "id": 1,
		    "font_family_default": "'Roboto Condensed', sans-serif",
		    "primary_color": "#FFC000",
		    "primary_opacity_color": "#2c2e2c",
		    "secundary_color": "#0c0c0c",
		    "gray_dark_color": "#0c0c0c",
		    "gray_light_color": "#0c0c0c",
		    "gray_medium_color": "#0c0c0c",
		    "gray_over_color": "#0c0c0c",
		    "title_color": "#0c0c0c",
		    "text_color": "#0c0c0c",
		    "sub_text_color": "#0c0c0c",
		    "placeholder_color": "#0c0c0c",
		    "background_color": "#0c0c0c",
		    "background_base": " #141414",
		    "background_base_dark": "#141414",
		    "carousel_banners": " #141414",
		    "carousel_banners_dark": " #141414",
		    "sidebar_color": " #141414",
		    "sidebar_color_dark": " #141414",
		    "navtop_color": " #141414",
		    "navtop_color_dark": " #141414",
		    "side_menu": " #141414",
		    "side_menu_dark": " #141414",
		    "input_primary": "#0c0c0c",
		    "input_primary_dark": "#0c0c0c",
		    "footer_color": " #141414",
		    "footer_color_dark": " #141414",
		    "card_color": "#0c0c0c",
		    "card_color_dark": "#0c0c0c",
		    "border_radius": ".25rem",
		    "custom_css": "",
		    "custom_js": null,
		    "created_at": "2024-01-01T17:36:03.000000Z",
		    "updated_at": "2024-05-04T21:52:11.000000Z",
		    "custom_header": null,
		    "custom_body": null,
		    "instagram": "{{ $custom['instagram'] }}",
		    "facebook": "{{ $custom['facebook'] }}",
		    "telegram": "{{ $custom['telegram'] }}",
		    "twitter": "{{ $custom['twitter'] }}",
		    "whastapp": "{{ $custom['whastapp'] }}",
		    "youtube": "{{ $custom['youtube'] }}",
		    "juridico": "juridico@<?= $custom['linkcassino'] ?>",
		    "suporte": "suporte@<?= $custom['linkcassino'] ?>",
		    "parceiros": "parceiros@<?= $custom['linkcassino'] ?>",
		    "texto_deposito": "{{ $custom['texto_deposito'] }}",
		    "texto_header": "{{ $custom['texto_header'] }}",
		    "texto_buton_bonus": "{{ $custom['texto_bonus'] }}"
		};
	</script> @if(!empty($custom['custom_js'])) <script>
		{
		    !!$custom['custom_js'] !!
		}
	</script> @endif
</body>

</html>