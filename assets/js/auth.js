
async function login(event){
    event.preventDefault();

    const nombreUsuario = document.getElementById('username').value;
    const claveUsuario = document.getElementById('password').value;
    try {
        const respuesta = await fetch('auth/login',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
            },
            body:JSON.stringify({
                nombreUsuario, claveUsuario
            })
        });

        const respuestaJson = await respuesta.json();
        
        if(respuestaJson.status === 'error'){
            showAlertAuth('loginAlert','error',respuestaJson.message);
            return false;
        }

        //Redireccionar a la pagina web
        window.location.href = '/web';

    } catch (error) {
        showAlertAuth('loginAlert','error','Error al iniciar sesión: '.error);
        return false;
    }
}

function register(){

}



function showAlertAuth(containerId, type, message) {
    const container = document.getElementById(containerId);
    container.innerHTML = `
        <div class="alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    // Auto-cerrar después de 5 segundos
    setTimeout(() => {
        const alert = container.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}