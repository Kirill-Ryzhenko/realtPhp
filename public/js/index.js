$(document).ready(function() {
    const element = document.querySelector('input[type="tel"]');
    if (element) {
        const maskOptions = {
            mask: '+375 (00) 000-00-00',
        };
        IMask(element, maskOptions);
    }

    $('.tabs').tabs()

    $('.dropdown-trigger').dropdown()

    $('.modal').modal();

    $('select').formSelect()

    $('.carousel').carousel({
        fullWidth: true,
        indicators: true,
    });

    $('input.autocomplete').autocomplete({
        data: {}
    })

    // var streetInput = $('input#street')[0];
    // if ($('input#street')) {
    //     $('input#street').change((e) => {
    //         ymaps.suggest(`Беларусь, Минск, ${e.target.value}`, { results: 5 }).then(function (items) {
    //             const newObj = Array.from(items, x => x.value)
    //             const streets = []
    //             const re = /(Беларусь, Минск, )|( улица )|( улица)|(улица )/g;
    //             for (let i = 0; i < newObj.length; i++) {
    //                 streets.push(newObj[i].replace(re, '').trim())
    //             }
    //             streetInstance.updateData(Object.assign(...streets.map((k, i) => ({
    //                 [k]: null
    //             }))));
    //         })
    //     })
    //
    //
    //     ymaps.ready(function () {
    //         let myMap = new ymaps.Map('YMapsID', {
    //             center: [53.9, 27.56],
    //             zoom: 11,
    //             controls: ['zoomControl', 'typeSelector', 'fullscreenControl']
    //         });
    //
    //         let myGeocoder = ymaps.geocode('Беларусь, Минск ')
    //         if (streetInput.value !== '') {
    //             myGeocoder = ymaps.geocode(`Беларусь, Минск,  ${streetInput.value}`)
    //             myGeocoder.then(function (res) {
    //                 myMap.geoObjects.add(res.geoObjects)
    //             })
    //         } else {
    //             myGeocoder.then(function (res) {
    //                 myMap.geoObjects.remove(res.geoObjects)
    //             });
    //         }
    //
    //         streetInput.addEventListener('blur', (e) => {
    //             myGeocoder.then(function (res) {
    //                 myMap.geoObjects.remove(res.geoObjects)
    //             })
    //
    //             if (e.target.value !== '') {
    //                 myGeocoder = ymaps.geocode(`Беларусь, Минск,  ${e.target.value}`)
    //
    //                 myGeocoder.then(function (res) {
    //                     myMap.geoObjects.add(res.geoObjects)
    //                 })
    //             }
    //         }, true)
    //     });
    // }
    //
    const streetInput = document.querySelector('input#street')
    if (streetInput) {
        streetInput.addEventListener('input', (e) => {
            ymaps.suggest(`Беларусь, Минск, ${e.target.value}`, { results: 5 }).then(function (items) {
                const newObj = Array.from(items, x => x.value)
                const streets = []
                const re = /(Беларусь, Минск, )|( улица )|( улица)|(улица )/g;
                for (let i = 0; i < newObj.length; i++) {
                    streets.push(newObj[i].replace(re, '').trim())
                }
                streetInstance.updateData(Object.assign(...streets.map((k, i) => ({
                    [k]: null
                }))));
            })
        })


        ymaps.ready(function () {
            let myMap = new ymaps.Map('YMapsID', {
                center: [53.9, 27.56],
                zoom: 11,
                controls: ['zoomControl', 'typeSelector', 'fullscreenControl']
            });

            let myGeocoder = ymaps.geocode('Беларусь, Минск ')
            if (streetInput.value !== '') {
                myGeocoder = ymaps.geocode(`Беларусь, Минск,  ${streetInput.value}`)
                myGeocoder.then(function (res) {
                    myMap.geoObjects.add(res.geoObjects)
                })
            } else {
                myGeocoder.then(function (res) {
                    myMap.geoObjects.remove(res.geoObjects)
                });
            }

            streetInput.addEventListener('blur', (e) => {
                myGeocoder.then(function (res) {
                    myMap.geoObjects.remove(res.geoObjects)
                })

                if (e.target.value !== '') {

                    myGeocoder = ymaps.geocode(`Беларусь, Минск,  ${e.target.value}`)

                    myGeocoder.then(function (res) {
                        myMap.geoObjects.add(res.geoObjects)
                    })
                }
            }, true)
        });
    }
})