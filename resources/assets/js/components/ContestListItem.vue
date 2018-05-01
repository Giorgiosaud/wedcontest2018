<template>
    <div>
        <div class="mr-4">
            <img
                    :src="creator.avatar_path"
                    :alt="creator.name+' '+creator.last_name"
                    class="w-8 h-8 bg-blue-darker rounded-full p-2"
            >
        </div>
        <div class="flex-1 border-b border-blue-lightest">

            <div class="flex align-center justify-end">
                <h3 class="flex-1 text-xl font-normal mb-2 tracking-tight">

                    <a :href="contest.path" class="text-blue" v-text="contest.topic"></a>

                </h3>
                <div class="bg-blue-lighter hover:bg-blue-light text-white font-light mr-2 py-2 px-4 rounded-full" v-text="contest.year">
                </div>
                <div v-if="contest.active"
                     class="bg-blue hover:bg-blue-dark text-white font-light py-2 px-4 rounded-full">
                    Active
                </div>
                <div v-else class="bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded-full">
                    Inactive
                </div>
            </div>
            <p class="text-2xs text-grey-darkest mb-4">
                {{creator.name}} {{creator.last_name}}
            </p>
            <div class="mb-6 text-grey-darkest leading-loose pr-8" v-text="contest.description"></div>
            <a class="btn ml-auto is-outlined text-grey-darker py-2 text-xs" :href="contest.path">read more</a>
        </div>
    </div>
</template>

<script>
export default {
  props: ["contest", "creator"],
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
