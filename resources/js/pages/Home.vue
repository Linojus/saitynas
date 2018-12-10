<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Welcome to Home</div>
            <div class="card-body">
                <p>
                    American  Main Barbary Coast scuttle hardtack spanker fire ship grapple jack code  of conduct port. Port red ensign Shiver me timbers provost salmagundi  bring a spring upon her cable pillage cog crow's nest lateen sail.  Barbary Coast quarterdeck lass coffer keel hulk mizzen me square-rigged  loot.
                </p>
                <p>
                    Yardarm starboard keelhaul list schooner prow booty cackle  fruit gabion topmast. Plunder shrouds Nelsons folly jack Arr parley warp  grog blossom ballast pressgang. Knave crack Jennys tea cup flogging log  man-of-war hearties killick long clothes six pounders hulk.
                </p>
            </div>

            <div v-if="$auth.check()" class="card card-default">
                <div class="card-header">Topic list</div>
                <div class="card-body">
                    <topicList></topicList>
                </div>
            </div>



        </div>
    </div>
</template>
<script>
    import topicList from '../components/topic-list.vue'
    export default {
        mounted() {
            //
        },
        components: {
            topicList
        }
    }
</script>