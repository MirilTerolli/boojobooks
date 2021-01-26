<template>
    <transition name="fade" :duration="{ enter: 1000, leave: 1000 }">
        <ul class="grid md:grid-cols-4 sm:grid-cols-2 mb-3 p-3">
            <li v-for="occurrence in skeletonOccurrence"
                class="col-span-2 bg-white rounded-lg shadow divide-y divide-gray-200 m-1">
                <vcl-facebook></vcl-facebook>
            </li>
        </ul>
    </transition>
</template>

<script>
import {VclFacebook} from 'vue-content-loading';
export default {
    name: "BooksSearchLoaderComponent",
    components: {
        VclFacebook
    },
    data() {
        return {
            skeletonOccurrence: _.random(1,10) //It's just a random number to show the skeleton count for
        }
    }

}
</script>

<style scoped>

</style>
