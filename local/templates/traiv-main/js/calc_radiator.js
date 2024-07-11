
//jQuery.noConflict();


ajax_calculator = {
    array_diameter:{13: 42, 14: 48, 15: 57, 16: 76, 17: 89, 18: 108, 19: 114, 20: 133, 21: 159, 22: 219},
    array_rate_margins:{13: 2, 14: 2, 15: 1.6, 16: 1.6, 17: 1.5, 18: 1.5, 19: 1.6, 20: 1.5, 21: 1.5, 22: 1.5},
    array_static: [30, 30, 200, 1044],
    array_wall_thickness:{
        price: {25: 2, 26: 2.5, 27: 3, 28: 3.5, 29: 4, 30: 4.5, 31: 5, 32: 6},
        weight:{17: 2, 18: 2.5, 19: 3, 20: 3.5, 21: 4, 22: 4.5, 23: 5, 24: 6}
    },

    array_table_data:{
        13: [48, 3, 0.2, 40, 3, 20, 0.1, 2400, 20, 3, 0.032627167583489, null, 21.3, 2.8, 1.16, 60],
        14: [60, 3, 0.3, 50, 2.5, 20, 0.07, 2800, 25, 3, 0.042615076027415, null, 21.3, 2.8, 1.16, 60],
        15: [75, 3.5, 0.5, 60, 3, 30, 0.2, 5400, 30, 3, 0.060093915804284, null, 21.3, 2.8, 1.16, 60],
        16: [100, 3.5, 1, 113, 3.5, 40, 0.4, 9600, 45, 3, 0.10683362809651, null, 21.3, 2.8, 1.16, 60],
        17: [120, 3.5, 1.4, 165, 3.5, 45, 0.4, 12600, 65, 3, 0.14650781997099, null, 21.3, 2.8, 1.16, 60],
        18: [150, 4, 2.5, 260, 4, 50, 0.7, 17000, 90, 3, 0.21573882238879, null, 26.8, 2.5, 1.5, 76],
        19: [150, 4, 2.6, 400, 4, 50, 0.7, 19000, 110, 4, 0.32050088428952, null, 26.8, 2.5, 1.5, 76],
        20: [190, 4, 3.8, 420, 4, 55, 0.9, 23000, 115, 4, 0.4362373147274, null, 26.8, 2.5, 1.5, 76],
        21: [225, 4.5, 6.1, 670, 4.5, 65, 1.5, 32500, 185, 5, 0.7793343005274, null, 33.5, 3.2, 2.39, 105],
        22: [300, 5, 13, 1470, 6, 75, 4, 51600, 330, 5, 1.4784878916022, null, 33.5, 3.2, 2.39, 105]
    },
    array_wall_thickness_data:{
        13:{
            price:{25: 90, 26: 108, 27: 126, 28: null, 29: null, 30: null, 31: null, 32: null},
            weight:{17: 2.07, 18: 2.49, 19: 2.9, 20: null, 21: null, 22: null, 23: null, 24: null}
        },
        14:{
            price:{25: 106, 26: 134, 27: 142, 28: null, 29: null, 30: null, 31: null, 32: null},
            weight:{17: 2.52, 18: 2.93, 19: 3.34, 20: null, 21: null, 22: null, 23: null, 24: null}
        },
        15: {
            price:{25: null, 26: 152, 27: 164, 28: 185, 29: 212, 30: null, 31: null, 32: null},
            weight:{17: null, 18: 3.48, 19: 4.03, 20: 4.66, 21: 5.25, 22: null, 23: null, 24: null}
        },
        16: {
            price:{25: null, 26: 200, 27: 218, 28: 253, 29: 286, 30: null, 31: null, 32: null},
            weight:{17: null, 18: 4.64, 19: 5.4, 20: 6.32, 21: 7.16, 22: null, 23: null, 24: null}
        },
        17: {
            price:{25: null, 26: null, 27: 255, 28: 297, 29: 338, 30: null, 31: null, 32: null},
            weight:{17: null, 18: null, 19: 6.42, 20: 7.38, 21: 8.39, 22: null, 23: null, 24: null}
        },
        18: {
            price:{25: null, 26: null, 27: 313, 28: 363, 29: 410, 30: 457, 31: 532, 32: null},
            weight:{17: null, 18: null, 19: 7.82, 20: 9.1, 21: 10.3, 22: 11.6, 23: 12.7, 24: null}
        },
        19: {
            price:{25: null, 26: null, 27: null, 28: null, 29: 447, 30: 528, 31: 580, 32: null},
            weight:{17: null, 18: null, 19: null, 20: null, 21: 10.9, 22: 12.2, 23: 13.5, 24: null}
        },
        20: {
            price:{25: null, 26: null, 27: null, 28: null, 29: 515, 30: 575, 31: 638, 32: null},
            weight:{17: null, 18: null, 19: null, 20: null, 21: 12.8, 22: 14.3, 23: 15.8, 24: null}
        },
        21: {
            price:{25: null, 26: null, 27: null, 28: null, 29: 633, 30: 683, 31: 765, 32: 912},
            weight:{17: null, 18: null, 19: null, 20: null, 21: 15.5, 22: 17.3, 23: 19, 24: 22.9}
        },
        22: {
            price:{25: null, 26: null, 27: null, 28: null, 29: null, 30: null, 31: 1228, 32: 1463},
            weight:{17: null, 18: null, 19: null, 20: null, 21: null, 22: null, 23: 26.4, 24: 31.6}
        }
    }
};


(function( $ ) {

    $(function() {


        $('#table_diameter label').attr('title', 'Нажмите для выбора');
        function find_arrs(array, value) {
            var ret;
            $.each(array, function(k, val) {
                if(val == value){
                    ret = k;
                }
            });
            if(ret == ''){
                return -1;
            }else{
                return ret;
            }

        }
        function model_name (){
            var name = 'Р';
            var type_construction = $('input:radio[name=type_construction]:checked').val();

            if(type_construction == 0){ name = name + 'С'; }
            if(type_construction == 1){ name = name + 'З'; }
            if(type_construction == 2){ name = name + 'А'; }


            if($('input:radio[name=type_gag]:checked').val() == 0){
                name = name + 'П';
            }else{
                name = name + 'Э';
            }

            name = name + '-';
            name = name + $('input[name=count_segments]').val();
            name = name + 'x';

            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');

            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var dd = ajax_calculator.array_wall_thickness.weight[id_wall_thickness];

            name = name + ajax_calculator.array_diameter[id_tube_diameter];

            name = name + 'x';
            name = name +  dd.toFixed(1);
            name = name + '-';

            var length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                length_register = length_register + ($('input[name=length_register_sm]').val() * 10);
            }
            name = name + length_register;

            return name;
        }

        /* Функция расчета межосевого расстояния */
        function axle_base_distance(){
            var axlebase_distance = 0;
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            if($('input[name=count_segments]').val() > 1 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                axlebase_distance = 2*ajax_calculator.array_diameter[id_tube_diameter]+50;
            }
            if($('input[name=count_segments]').val() > 1 && $('input:radio[name=type_construction]:checked').val() == 1){
                axlebase_distance = 2*ajax_calculator.array_table_data[id_tube_diameter][0];
            }
            return axlebase_distance;
        }

        /* Функция расчета расстояния между сегментами */
        function distance_segments(){
            var v_distance_segments = 0;
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            if($('input[name=count_segments]').val() > 1 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                v_distance_segments = ajax_calculator.array_diameter[id_tube_diameter]+50;
            }
            if($('input[name=count_segments]').val() > 1 && $('input:radio[name=type_construction]:checked').val() == 1){
                v_distance_segments = 2*ajax_calculator.array_table_data[id_tube_diameter][0]-ajax_calculator.array_diameter[id_tube_diameter];
            }
            return v_distance_segments;
        }

        /* Функция расчета высоты */
        function construction_height(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var v_construction_height = ($('input[name=count_segments]').val() - 1) * axle_base_distance() + parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);
            return v_construction_height;
        }

        /* Функция расчета высоты заглушки */
        function height_caps(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];



            if($('input:radio[name=type_gag]:checked').val() == 0){
                var v_height_caps = ajax_calculator.array_table_data[id_tube_diameter][9];
            }
            if($('input:radio[name=type_gag]:checked').val() == 1){
                var v_height_caps = ajax_calculator.array_table_data[id_tube_diameter][5];
            }

            return parseFloat(v_height_caps);
        }

        /* Функция расчета площади упаковки */
        function area_package(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);
            var length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                length_register = length_register + ($('input[name=length_register_sm]').val() * 10);
            }

            var v_construction_height = construction_height();

            var v_area_package = 2*(tube_diameter * length_register + tube_diameter * v_construction_height + v_construction_height * length_register) / 1000000;

            return v_area_package;
        }

        /* Функция расчета длины верхней трубы */
        function length_top_tube(){
            var v_length_top_tube = 0;

            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                length_register = length_register + ($('input[name=length_register_sm]').val() * 10);
            }

            if($('input[name=count_segments]').val() > 1 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                v_length_top_tube = length_register - height_caps() * 2;
            }
            if($('input[name=count_segments]').val() > 1 && $('input:radio[name=type_construction]:checked').val() == 1){
                v_length_top_tube = length_register - height_caps() - parseFloat(ajax_calculator.array_table_data[id_tube_diameter][0]) - parseFloat(ajax_calculator.array_diameter[id_tube_diameter]) / 2 ;
            }
            return v_length_top_tube;
        }

        /* Функция расчета длины средней трубы */
        function length_middle_tube(){
            var v_length_middle_tube = 0;
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                length_register = length_register + ($('input[name=length_register_sm]').val() * 10);
            }

            if($('input[name=count_segments]').val() > 1 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                v_length_middle_tube = length_register - height_caps() * 2;
            }
            if($('input[name=count_segments]').val() > 1 && $('input:radio[name=type_construction]:checked').val() == 1){
                v_length_middle_tube = length_register - 2 * parseFloat(ajax_calculator.array_table_data[id_tube_diameter][0]) - parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);
            }
            return v_length_middle_tube;
        }

        /* Функция расчета длины нижней трубы */
        function length_lower_tube(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            var length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                length_register = length_register + ($('input[name=length_register_sm]').val() * 10);
            }

            var v_height_caps = height_caps();
            var v_length_lower_tube = 0;

            switch ($('input:radio[name=type_construction]:checked').val()) {
                case '0':
                    var type_mounting = 0;
                    break;
                case '1':
                    var type_mounting = 0;
                    break;
                case '2':
                    var type_mounting = 1;
                    break;
                case '3':
                    var type_mounting = 0;
                    break;
            }

            if($('input[name=count_segments]').val() > 1 && type_mounting == 0 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                v_length_lower_tube = length_register - v_height_caps * 2;
            }
            if($('input[name=count_segments]').val() > 1 && type_mounting == 0 && $('input:radio[name=type_construction]:checked').val() == 1){
                v_length_lower_tube = length_register - v_height_caps - parseFloat(ajax_calculator.array_table_data[id_tube_diameter][0]) - parseFloat(ajax_calculator.array_diameter[id_tube_diameter]) / 2;
            }
            if($('input[name=count_segments]').val() > 1 && type_mounting == 1 && ($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3)){
                v_length_lower_tube = length_register - ajax_calculator.array_table_data[id_tube_diameter][9] - v_height_caps;
            }
            if($('input[name=count_segments]').val() > 1 && type_mounting == 1 && $('input:radio[name=type_construction]:checked').val() == 1){
                v_length_lower_tube = length_register - ajax_calculator.array_table_data[id_tube_diameter][5] - ajax_calculator.array_table_data[id_tube_diameter][0] - parseFloat(ajax_calculator.array_diameter[id_tube_diameter]) / 2;
            }
            if($('input[name=count_segments]').val() == 1 || $('input[name=count_segments]').val() == ''){
                v_length_lower_tube = length_register - ajax_calculator.array_table_data[id_tube_diameter][9] - v_height_caps;
            }
            return v_length_lower_tube;
        }

        /* Функция расчета количества средних труб */
        function count_middle_tube(){
            var v_count_middle_tube = 0;
            var count_segments = $('input[name=count_segments]').val();
            if(count_segments > 2){
                v_count_middle_tube = count_segments -2;
            }

            return v_count_middle_tube;
        }

        /* Функция расчета суммарной длины всех труб */
        function total_length_tube(){
            var v_total_length_tube = length_top_tube() + length_lower_tube() + length_middle_tube() * count_middle_tube();

            return v_total_length_tube;
        }

        /* Функция расчета количества плоских заглушек */
        function count_flat_caps(){
            var v_count_flat_caps = 0;

            switch ($('input:radio[name=type_construction]:checked').val()) {
                case '0':
                    var type_mounting = 0;
                    break;
                case '1':
                    var type_mounting = 0;
                    break;
                case '2':
                    var type_mounting = 1;
                    break;
                case '3':
                    var type_mounting = 0;
                    break;
            }

            if(type_mounting == 0){
                if($('input:radio[name=type_gag]:checked').val() == 0){
                    if($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3){
                        v_count_flat_caps = $('input[name=count_segments]').val()*2;
                    }else{
                        v_count_flat_caps = 2;
                    }
                }
            }
            if(type_mounting == 1){
                if($('input:radio[name=type_gag]:checked').val() == 1){
                    v_count_flat_caps = 1;
                }else{
                    v_count_flat_caps = $('input[name=count_segments]').val()*2;
                }
            }

            return v_count_flat_caps;
        }

        /* Функция расчета количества эллиптических заглушек */
        function count_elliptic_caps(){
            var v_count_elliptic_caps = 0;
            switch ($('input:radio[name=type_construction]:checked').val()) {
                case '0':
                    var type_mounting = 0;
                    break;
                case '1':
                    var type_mounting = 0;
                    break;
                case '2':
                    var type_mounting = 1;
                    break;
                case '3':
                    var type_mounting = 0;
                    break;
            }
            if(type_mounting == 0){
                if($('input:radio[name=type_gag]:checked').val() == 1){
                    if($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3){
                        v_count_elliptic_caps = $('input[name=count_segments]').val()*2;
                    }else{
                        v_count_elliptic_caps = 2;
                    }
                }else{
                    if($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3){
                        v_count_elliptic_caps = 0;
                    }else{
                        v_count_elliptic_caps = 0;
                    }
                }
            }
            if(type_mounting == 1){
                if($('input:radio[name=type_gag]:checked').val() == 1){
                    v_count_elliptic_caps = ($('input[name=count_segments]').val()*2)-1;
                }
            }

            return v_count_elliptic_caps;
        }

        /* Функция расчета количества отводов 90 градусов */
        function count_taps_90_degrees(){
            var v_count_taps_90_degrees = 0;

            if($('input:radio[name=type_construction]:checked').val() == 1){
                v_count_taps_90_degrees = 2 * $('input[name=count_segments]').val() - 2;
            }

            return v_count_taps_90_degrees;
        }

        /* Функция расчета количества перемычек */
        function count_bridges(){
            var v_count_bridges = 0;

            if($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3){
                v_count_bridges = 2 * $('input[name=count_segments]').val() - 2;
            }
            if($('input:radio[name=type_construction]:checked').val() == 1){
                v_count_bridges = $('input[name=count_segments]').val() - 1;
            }

            return v_count_bridges;
        }

        /* Функция расчета длины перемычки */
        function length_bridge(){
            var v_length_bridge = 0;
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];

            if($('input[name=count_segments]').val() > 1){
                v_length_bridge = distance_segments() + ajax_calculator.array_wall_thickness.weight[id_wall_thickness] * 2;
            }

            return v_length_bridge;
        }

        /* Функция расчета суммарной длины перемычек */
        function summ_length_bridge(){
            var v_summ_length_bridge = count_bridges() * length_bridge();

            return v_summ_length_bridge;
        }

        /* Функция расчета видимой суммарной длины перемычек */
        function visible_summ_length_bridge(){
            var v_visible_summ_length_bridge = distance_segments() * count_bridges();

            return v_visible_summ_length_bridge;
        }

        /* Функция расчета площади поверхности */
        function surface_area(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            var v_surface_area = ((total_length_tube() + tube_diameter / 4 * count_flat_caps() + Math.PI * axle_base_distance() * count_taps_90_degrees())
                * tube_diameter + visible_summ_length_bridge() * ajax_calculator.array_table_data[id_tube_diameter][12]) * Math.PI + ajax_calculator.array_table_data[id_tube_diameter][7] * count_elliptic_caps();

            return v_surface_area;
        }

        /* Функция расчета объёма теплоносителя */
        function volume_coolant(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            if($('input:radio[name=type_construction]:checked').val() == 1) {
                var v_volume_coolant = (
                    Math.PI
                    * Math.pow(((tube_diameter - 2 * ajax_calculator.array_wall_thickness.weight[id_wall_thickness]) / 2), 2)
                    * total_length_tube()
                    + Math.pow(Math.PI, 2)
                    * axle_base_distance()
                    * Math.pow(tube_diameter - 2 * ajax_calculator.array_table_data[id_tube_diameter][1], 2)
                    / 8
                    * count_taps_90_degrees()
                    + Math.PI
                    * Math.pow(tube_diameter / 2, 2)
                    * height_caps()
                    / 3
                    * count_elliptic_caps()
                ) / 1000000000;
            }
            if($('input:radio[name=type_construction]:checked').val() == 0 || $('input:radio[name=type_construction]:checked').val() == 2 || $('input:radio[name=type_construction]:checked').val() == 3) {
                var v_volume_coolant = (
                    Math.PI
                    * Math.pow(((tube_diameter - 2 * ajax_calculator.array_wall_thickness.weight[id_wall_thickness]) / 2), 2)
                    * total_length_tube()
                    + 0
                    * Math.PI
                    * Math.pow((ajax_calculator.array_table_data[id_tube_diameter][12] - 2 * ajax_calculator.array_table_data[id_tube_diameter][13] / 2), 2)
                    * visible_summ_length_bridge() / 2
                    + Math.pow(Math.PI, 2)
                    * axle_base_distance()
                    * Math.pow(tube_diameter - 2 * ajax_calculator.array_table_data[id_tube_diameter][1], 2)
                    / 8
                    * count_taps_90_degrees()
                    + Math.PI
                    * Math.pow(tube_diameter / 2, 2)
                    * height_caps()
                    / 3
                    * count_elliptic_caps()
                ) / 1000000000;
            }
            return v_volume_coolant;
        }

        /* Функция расчета суммарной длины сварного шва */
        function total_length_weld(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            var v_total_length_weld = (
                (count_flat_caps() + count_elliptic_caps() + count_taps_90_degrees() * 1.5)
                * tube_diameter
                + count_bridges()
                * ajax_calculator.array_table_data[id_tube_diameter][12]
            ) * Math.PI ;

            return v_total_length_weld;
        }

        /* Функция расчета количества отрезков */
        function count_cuts(){
            var v_count_cuts = parseFloat($('input[name=count_segments]').val()) + count_bridges();

            return v_count_cuts;
        }

        /* Функция расчета веса */
        function calculation_weight(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);


            var v_calculation_weight = (total_length_tube() * ajax_calculator.array_wall_thickness_data[id_tube_diameter]['weight'][id_wall_thickness] + summ_length_bridge() * ajax_calculator.array_table_data[id_tube_diameter][14]) / 1000
                + ajax_calculator.array_table_data[id_tube_diameter][6]
                * count_elliptic_caps()
                + ajax_calculator.array_table_data[id_tube_diameter][10]
                * count_flat_caps()
                + ajax_calculator.array_table_data[id_tube_diameter][2]
                * count_taps_90_degrees();

            return v_calculation_weight;
        }

        /* Функция расчета максимальной мощности при t20 */
        function calculation_maximum_power(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            var count_segments = parseFloat($('input[name=count_segments]').val());
            var v_calculation_maximum_power = (1 + (count_segments - 1) * 0.9)
                * surface_area() / count_segments
                * 11.63 * (70-20) / 1000000;

            return v_calculation_maximum_power;
        }


        /* Функция расчета себестоимости материалов */
        function cost_materials(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            var wall_thickness_v = ajax_calculator.array_wall_thickness.weight[id_wall_thickness];
            var wall_thickness_price_id = find_arrs(ajax_calculator.array_wall_thickness.price, wall_thickness_v);

            var v_cost_materials = (ajax_calculator.array_wall_thickness_data[id_tube_diameter]['price'][wall_thickness_price_id] * total_length_tube() + ajax_calculator.array_table_data[id_tube_diameter][15] * summ_length_bridge()) / 1000
                + ajax_calculator.array_table_data[id_tube_diameter][8] * count_elliptic_caps()
                + ajax_calculator.array_table_data[id_tube_diameter][11] * count_flat_caps()
                + ajax_calculator.array_table_data[id_tube_diameter][3] * count_taps_90_degrees();

            return v_cost_materials;
        }

        /* Функция расчета себестоимости сварки */
        function cost_welding(){
            var v_cost_welding = total_length_weld() / 1000 * ajax_calculator.array_static[2];

            return v_cost_welding;
        }

        /* Функция расчета себестоимости резки */
        function cost_cutting(){
            var v_cost_cutting = count_cuts() * ajax_calculator.array_static[1];

            return v_cost_cutting;
        }

        /* Функция расчета себестоимости грунтовки */
        function cost_primer(){
            if($('input[name=ground]').prop('checked') == true){
                var count_segments = parseFloat($('input[name=count_segments]').val());
                var length_register = parseFloat($('input[name=length_register_m]').val())*1000;
                if($('input[name=length_register_sm]').val() !== 0){
                    length_register = length_register + parseFloat($('input[name=length_register_sm]').val() * 10);
                }

                var v_cost_primer = count_segments * (length_register/1000) * ajax_calculator.array_static[0];
            }else{
                var v_cost_primer = 0;
            }

            return v_cost_primer;
        }

        /* Функция расчета себестоимости покраски */
        function cost_painting(){
            if($('input[name=ground]').prop('checked') == true && $('input[name=dyeing]').prop('checked') == true){
                var count_segments = parseFloat($('input[name=count_segments]').val());
                var length_register = parseFloat($('input[name=length_register_m]').val())*1000;
                if($('input[name=length_register_sm]').val() !== 0){
                    length_register = length_register + parseFloat($('input[name=length_register_sm]').val() * 10);
                }
                var v_cost_painting = count_segments * (length_register/1000) * ajax_calculator.array_static[0];
            }else{
                var v_cost_painting = 0;
            }

            return v_cost_painting;
        }

        /* Функция расчета себестоимости грунтовки и покраски */
        function cost_priming_and_painting(){
            if($('input[name=ground]').prop('checked') == true && $('input[name=dyeing]').prop('checked') == true){
                var v_cost_priming_and_painting = cost_primer() + cost_painting();
            }else{
                var v_cost_priming_and_painting = 0;
            }

            return v_cost_priming_and_painting;
        }

        /* Функция расчета себестоимости без грунтовки и покраски */
        function cost_without_priming_and_painting(){

            var v_cost_without_priming_and_painting = cost_materials() + cost_welding() + cost_cutting();

            return v_cost_without_priming_and_painting;
        }


        /* Функция расчета цены */
        function calculation_price(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];



            var price = cost_without_priming_and_painting();
            if($('input:radio[name=type_construction]:checked').val() == '2'){
                price = price + ajax_calculator.array_static[3];
            }
            price = price * parseFloat(ajax_calculator.array_rate_margins[id_tube_diameter]);
            return price;
        }

        function m_cost(){
            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var tube_diameter = parseFloat(ajax_calculator.array_diameter[id_tube_diameter]);

            var wall_thickness_v = ajax_calculator.array_wall_thickness.weight[id_wall_thickness];
            var wall_thickness_price_id = find_arrs(ajax_calculator.array_wall_thickness.price, wall_thickness_v);

            var cost_ten = 0;


            if ($("#table-manager-info")){
                if($('input:radio[name=type_construction]:checked').val() == '2'){
                    cost_ten = ajax_calculator.array_static[3];
                }

                $('#table-manager-info .length_top_tube').text(length_top_tube()/1000);
                $('#table-manager-info .length_middle_tube').text(length_middle_tube()/1000);
                $('#table-manager-info .length_lower_tube').text(length_lower_tube()/1000);
                $('#table-manager-info .count_middle_tube').text(count_middle_tube());
                $('#table-manager-info .summ_length_bridge').text(summ_length_bridge()/1000);
                $('#table-manager-info .cost_ten').text(cost_ten);
                $('#table-manager-info .count_taps_90_degrees').text((ajax_calculator.array_table_data[id_tube_diameter][3] * count_taps_90_degrees()).toFixed(1));
                $('#table-manager-info .cost_materials').text((cost_materials()+cost_ten).toFixed(1));
                $('#table-manager-info .cost_welding_cost_cutting').text((cost_welding()+cost_cutting()).toFixed(1));
                $('#table-manager-info .cost_materials_cost_welding_cost_cutting').text((cost_materials()+cost_welding()+cost_cutting()+cost_ten).toFixed(1));
                $('#table-manager-info .calculation_price').text((calculation_price() - (cost_materials()+cost_welding()+cost_cutting())).toFixed(1));
            }

        }

        function update_table_client (){

            m_cost();


            var s_tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var s_array_tube_wall = s_tube_diameter.split('_');
            var s_id_tube_diameter = s_array_tube_wall[0];
            var s_id_wall_thickness = s_array_tube_wall[1];

            var id_for = 'edit-tube-diameter-' + s_array_tube_wall[0] + '-' + s_array_tube_wall[1];
            var text_label = ajax_calculator.array_diameter[s_id_tube_diameter] + 'x' + ajax_calculator.array_wall_thickness.weight[s_id_wall_thickness];

            $('#table_diameter label').removeClass('active');
            $('#table_diameter label').text(' ');

            $('#table_diameter label[for='+id_for+']').addClass('active');
            $('#table_diameter label[for='+id_for+']').text(text_label);


            var value_model_name = model_name();

            switch ($('input:radio[name=type_construction]:checked').val()) {
                case '0':
                    var value_type_construction = 'Секционный';
                    var value_type_mounting = 'Стационарный';
                    var value_type_construction_i = 0;
                    break;
                case '1':
                    var value_type_construction = 'Змеевиковый';
                    var value_type_mounting = 'Стационарный';
                    var value_type_construction_i = 1;
                    break;
                case '2':
                    var value_type_construction = 'Автономный';
                    var value_type_mounting = 'Автономный';
                    var value_type_construction_i = 2;
                    break;
                case '3':
                    var value_type_construction = 'Однорядный';
                    var value_type_mounting = 'Стационарный';
                    var value_type_construction_i = 3;
                    break;
            }


            if($('input:radio[name=type_gag]:checked').val() == 0){
                var value_type_gag = 'Плоские';
                var value_type_gag_i = 0;
            }else{
                var value_type_gag = 'Эллиптические';
                var value_type_gag_i = 1;
            }

            var value_count_segments = $('input[name=count_segments]').val();

            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            var array_tube_wall = tube_diameter.split('_');
            var id_tube_diameter = array_tube_wall[0];
            var id_wall_thickness = array_tube_wall[1];
            var value_tube_diameter = ajax_calculator.array_diameter[id_tube_diameter];
            var value_wall_thickness = ajax_calculator.array_wall_thickness.weight[id_wall_thickness];

            var value_length_register = $('input[name=length_register_m]').val()*1000;
            if($('input[name=length_register_sm]').val() !== 0){
                value_length_register = value_length_register + ($('input[name=length_register_sm]').val() * 10);
            }

            var value_construction_height = construction_height();

            if($('input[name=count_segments]').val() > 1){
                var value_diameter_jumpers = ajax_calculator.array_table_data[id_tube_diameter][12];
            }else{
                var value_diameter_jumpers = 0;
            }

            var value_axle_base_distance = axle_base_distance();

            var value_distance_segments = distance_segments();

            var value_volume_coolant = volume_coolant()*1000;
            var value_volume_coolant_m = value_volume_coolant/1000;
            var value_calculation_maximum_power = calculation_maximum_power();
            var value_calculation_weight = calculation_weight();
            // var value_price_ground = cost_primer();
            // var value_price_painting = cost_painting();
            var value_calculation_price = calculation_price();
            var value_surface_area = surface_area()/1000000;

            var value_total_length_tube = total_length_tube()/1000;

            $('#table-client-info .model-name').text(value_model_name);
            $('#table-client-info .type-construction').text(value_type_construction);
            $('#table-client-info .type-gag').text(value_type_gag);
            $('#table-client-info .type-mounting').text(value_type_mounting);
            $('#table-client-info .count-segments').text(value_count_segments);
            $('#table-client-info .tube-diameter').text(value_tube_diameter);
            $('#table-client-info .wall-thickness').text(value_wall_thickness);
            $('#table-client-info .length-register').text(value_length_register);
            $('#table-client-info .construction-height').text(Math.round(value_construction_height));
            $('#table-client-info .construction-depth').text(value_tube_diameter);
            $('#table-client-info .diameter-jumpers').text(value_diameter_jumpers);
            $('#table-client-info .axle-base-distance').text(Math.round(value_axle_base_distance));
            $('#table-client-info .distance-segments').text(Math.round(value_distance_segments));
            $('#table-client-info .surface-area').text(value_surface_area.toFixed(2));
            $('#table-client-info .total-length-tube').text(value_total_length_tube.toFixed(2));
            $('#table-client-info .volume-coolant').text(value_volume_coolant.toFixed(1) + ' | ' + value_volume_coolant_m.toFixed(4));
            $('#table-client-info .calculation-maximum-power').text(Math.round(value_calculation_maximum_power));
            $('#table-client-info .calculation-weight').text(value_calculation_weight.toFixed(2));
            // $('#table-client-info .calculation-price-ground').text(Math.round(value_price_ground));
            // $('#table-client-info .calculation-price-painting').text(Math.round(value_price_painting));
            $('#table-client-info .calculation_price').text(Math.ceil(value_calculation_price/10)*10);
            $('.total_price_calc span').text(Math.ceil(value_calculation_price/10)*10);

            // jsURL.urlVar('d', value_tube_diameter);
            // jsURL.urlVar('n', value_count_segments);
            // jsURL.urlVar('c', value_type_gag_i);
            // jsURL.urlVar('k', value_type_construction_i);
            // jsURL.urlVar('l', value_length_register/1000);
            // jsURL.urlVar('w', value_wall_thickness);
        }


        function update_tables (){
            update_table_client ();

            var date = new Date;
            date.setDate(date.getDate() + 1);

            var tube_diameter = $('input:radio[name=tube_diameter]:checked').val();
            document.cookie = "d=" + tube_diameter + "; path=/; expires=" + date.toUTCString();

            var value_count_segments = $('input[name=count_segments]').val();
            document.cookie = "n=" + value_count_segments + "; path=/; expires=" + date.toUTCString();

            var type_construction = $('input:radio[name=type_construction]:checked').val();
            document.cookie = "k=" + type_construction + "; path=/; expires=" + date.toUTCString();

            var type_gag = $('input:radio[name=type_gag]:checked').val();
            document.cookie = "c=" + type_gag + "; path=/; expires=" + date.toUTCString();

            var length_register_m = $('input[name=length_register_m]').val();
            var length_register_sm = $('input[name=length_register_sm]').val();
            document.cookie = "l_m=" + length_register_m + "; path=/; expires=" + date.toUTCString();
            document.cookie = "l_sm=" + length_register_sm + "; path=/; expires=" + date.toUTCString();


        }

        $('input#edit-length-register-m').attr('readonly', true);
        $('input#edit-length-register-sm').attr('readonly', true);
        $('input#edit-count-segments').attr('readonly', true);

        $('input#edit-length-register-m').spinner({
            min: 1,
            step: 1,
            change: function( event, ui ) {
                update_tables ();
            },
            spin: function( event, ui ) {
                $(this).val(ui.value);
                update_tables ();
            }
        });
        $('input#edit-length-register-sm').spinner({
            min: 0,
            step: 10,
            max: 90,
            change: function( event, ui ) {

            },
            spin: function( event, ui ) {
                $(this).val(ui.value);
                update_tables ();
            }
        });
        var count_segments_spinner = $('input#edit-count-segments').spinner({
            min: 1,
            step: 1,
            change: function( event, ui ) {

            },
            spin: function( event, ui ) {
                if(ui.value == 1){
                    if($('input:radio[name=type_construction]:checked').val() !== 3){
                        $('input#edit-type-construction-3').prop('checked', true);
                    }
                }else{
                    if($('input:radio[name=type_construction]:checked').val() == 3){
                        $('input#edit-type-construction-0').prop('checked', true);
                    }
                }
                $(this).val(ui.value);
                update_tables ();
            }
        });

        $('input:radio, input:checkbox, input:text').change(function () {
            if($('input:radio[name=type_construction]:checked').val() !== '3'){
                if($('input#edit-count-segments').val() == 1){
                    count_segments_spinner.spinner( "value", 2 );
                }else{
                    count_segments_spinner.spinner( "value",  $('input#edit-count-segments').val());
                }

            }else{
                count_segments_spinner.spinner( "value", 1 );
            }
            update_tables ();
        });

        update_tables ();

    });

})(jQuery);
