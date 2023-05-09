const RUTA_GLOBAL = "http://localhost/adeudos-salon/index.php/";

const post = async(payload, ruta)=>{
    let peticion =  await fetch(RUTA_GLOBAL + ruta,{
        method: 'POST',
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify(payload)
        })

        return await peticion.json();
}

const get = async (ruta) => {
    let peticion = await fetch(RUTA_GLOBAL + ruta);
    return  peticion.json();
}