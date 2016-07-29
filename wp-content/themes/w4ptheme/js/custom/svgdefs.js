(function (document) {
    var container = document.querySelector('#svgPlaceholder');

    if (container) {
    
        container.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\"/>";

    

    } else {
        throw new Error('svginjector: Could not find element: #svgPlaceholder');
    }

})(document);
