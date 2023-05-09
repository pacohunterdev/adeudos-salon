<div class="loader-wrapper">
    <div class="loader">
        <img src="<?php echo base_url()?>assets/img/logo2.png" alt="Spinner">
    </div>
</div>
<script>
    const mostrarCargando = () => {
        document.querySelector('.loader').style.display = 'flex';
        document.querySelector('.loader-wrapper').style.display = 'flex';
    }

    const ocultarCargando = ()=> {
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.loader-wrapper').style.display = 'none';
        document.body.style.overflow = "auto";
    }
</script>
<style>
    .loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); 
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; 
    }

    .loader {
    width: 400px; 
    height: 355px; 
    border-radius: 50%;
    border: none;
    animation: loader-rotate 3s infinite linear;
    background-color: transparent; 
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .loader img {
    width: 100%; 
    height: 100%; 
    opacity: 0.8; 
    }

    @keyframes loader-rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }

    body {
    overflow: hidden; 
    }

    .loader-wrapper::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none; 
    }
</style>