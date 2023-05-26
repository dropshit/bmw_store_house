<script>
    // dropdown listi almaq ucun
    var seriesDropdown = document.getElementById("series");
    var modelDropdown = document.getElementById("model");

    // model melumatini almaq ucun
    var modelsData = <?php echo json_encode($models_data); ?>;

    // dropdown listde seriani aldiqdan sonra event listenerle modeli elaqelendirmek
    seriesDropdown.addEventListener("change", function() {
        // daxil edilen seriyani almaq ucun
        var selectedSeries = seriesDropdown.value;

        //model dropdown listinin daxilindekileri temizlemek ucun
        modelDropdown.innerHTML = "";
        modelDropdown.disabled = false;

        // seriya secilmeyibse modeli disable etmek ucun
        if (selectedSeries === "") {
            modelDropdown.disabled = true;
            return;
        }

        // seriaya uygun modeli almaq ucun
        var models = modelsData[selectedSeries];

        // her modeli <option> olaraq elave etmek ucun
        for (var i = 0; i < models.length; i++) {
            var option = document.createElement("option");
            option.value = models[i];
            option.text = models[i];
            modelDropdown.appendChild(option);
        }
    });
</script>