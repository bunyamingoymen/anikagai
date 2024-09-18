<div class="mt-3 mb-5">
    <label for="selectCategory">Kategoriler:</label>
    <select name="selectCategory[]" id="selectCategory" style="width: 100%;" onchange="changeSelectCategory()" multiple >
    </select>
</div>
<div class="mt-5" id="allFeaturesDiv">
</div>

<!-- Select2 ve kategori ayarları -->
<script>
    @if (isset($categories))
        var selectedCategories = @json($categories);
    @endif

    @if (isset($featuresAnswers))
        var featuresAnswers = @json($featuresAnswers);
        featuresAnswers = Object.values(featuresAnswers);
    @else
        var featuresAnswers = [];
    @endif

    function changeSelectCategory(){
        // Select elementini al
        const selectElement = document.getElementById('selectCategory');

        // Seçilen tüm değerleri almak için boş bir dizi oluştur
        const selectedValues = [];

        // Seçilen option öğelerini bul ve değerlerini diziye ekle
        for (const option of selectElement.options) {
            if (option.selected) {
                selectedValues.push(option.value);
            }
        }

        var pageData = {
            page: 1,
            showingCount: 100,
            category_codes: selectedValues,
        }
        if(selectedValues.length>0){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_shop_feature_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var items = response.items;
                        var page_count = response.page_count;
                        var key_values = Object.values(response.key_values.items);
                        var html = ``;

                        var features_inputs = document.getElementsByClassName('features_inputs');
                        var features_values = [];

                        features_inputs.forEach(element => {

                            if(element.id === element.value){
                                var features_value = {
                                    id: element.id,
                                    value: element.checked,
                                };
                            }
                            else{
                                var features_value = {
                                    id: element.id,
                                    value: element.value,
                                };
                            }

                            features_values.push(features_value);
                        });

                        for (let i = 0; i < items.length; i++) {
                            var keyValues = key_values.filter(value=> value.optional === items[i].code);
                            var answer="";
                            for(let j=0; j<featuresAnswers.length; j++){
                                if(items[i].code === featuresAnswers[j].feature_code){
                                    answer = featuresAnswers[j].answer;
                                }
                            }
                            if(keyValues.length>0){
                                html += `
                                    <div class="mt-3">
                                        <label for="">${items[i].name}</label>
                                        <div class="mt-4 mt-lg-0">
                                            `

                                keyValues.forEach(element => {
                                    if(element.code === answer){
                                        html += `<div class="form-check form-check-inline">
                                                    <input class="form-check-input features_inputs" type="radio" name="features[${items[i].code}]" id="${element.code}" value="${element.code}" checked>
                                                    <label class="form-check-label" for="${element.code}">
                                                        ${element.value}
                                                    </label>
                                                </div>
                                        `
                                    }else{
                                        html += `<div class="form-check form-check-inline">
                                                    <input class="form-check-input features_inputs" type="radio" name="features[${items[i].code}]" id="${element.code}" value="${element.code}">
                                                    <label class="form-check-label" for="${element.code}">
                                                        ${element.value}
                                                    </label>
                                                </div>
                                        `
                                    }

                                });

                                html += `
                                        </div>
                                    </div>
                                `
                            }else{
                                html += `<div class="mt-3">
                                                <label for="${items[i].code}">${items[i].name}</label>
                                                <input type="text" id="${items[i].code}" name="features[${items[i].code}]" class="form-control features_inputs" placeholder="Bir değer giriniz" value="${answer}">
                                        </div>
                                        `
                            }

                        }

                        document.getElementById('allFeaturesDiv').innerHTML = html;

                        features_values.forEach(element => {
                            if(document.getElementById(element.id)){
                                if(element.value === true) document.getElementById(element.id).checked = element.value;
                                else document.getElementById(element.id).value = element.value;
                            }
                        });

                    }
                });
        }else{
            document.getElementById('allFeaturesDiv').innerHTML = ``;
        }
    }

    function configSelect2(){
        $('#selectCategory').select2({
            ajax: {
                url: '{{ route('admin_shop_category_get_data') }}', // Laravel controller endpoint'iniz
                dataType: 'json',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token'ı ekle
                },
                data: function(params) {
                    return {
                        search: params.term,
                        page: 1,
                        // Diğer parametreleri burada ekleyebilirsiniz
                    };
                },
                processResults: function(response) {
                    return {
                        results: $.map(response.items, function(item) {
                            return {
                                id: item.code,
                                text: item.name,
                                // Diğer alanları burada ekleyebilirsiniz
                            };
                        }),
                        pagination: {
                            more: response.page_count > 1 // Eğer daha fazla sayfa varsa true döndürün
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Kategori Ara...',
            minimumInputLength: 3, // Minimum giriş uzunluğu
            escapeMarkup: function(markup) {
                return markup;
            }, // Markdown işlemlerini önlemek için
            //theme: "bootstrap",
            templateResult: formatResult, // Sonuçları özelleştirmek için
            templateSelection: formatResult, // Seçili öğeyi özelleştirmek için
            //matcher: function(term, text) { return text.name.toUpperCase().indexOf(term.toUpperCase()) != -1; },
        })

        function formatResult(item) {
            return item.text;
        }

        @if (isset($categories))
            selectedCategories.forEach(function(category, index, array) {
                var option = new Option(category.name, category.code, true, true);
                $('#selectCategory').append(option).trigger('change');
            });

        @endif
    }
</script>
