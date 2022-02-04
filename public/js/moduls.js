
export function queryServer({method, url, asyc=true, data = null }){
    const xrh = new XMLHttpRequest();
    xrh.open(
        method,
        url,
        asyc
    )
    xrh.send(data);
    return xrh;
}