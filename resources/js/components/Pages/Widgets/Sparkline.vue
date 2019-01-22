<template lang="pug">
    .sparkline
</template>

<script>
    import * as $ from "jquery"
    import "jquery-sparkline"

    export default {
        props: ["items"],
        mounted: function(){
            $(this.$el).sparkline(this.items, {
                type: 'bar',
                width: '100%',
                lineColor: '#3497dc',
                fillColor: '#3497dc',
                spotColor: '#3497dc',
                minSpotColor: '#3497dc',
                maxSpotColor: '#3497dc',
                highlightSpotColor: '#3497dc',
                highlightLineColor: '#3497dc',
                drawNormalOnTop: false,
                zeroAxis: false
            });
        }
    }
</script>