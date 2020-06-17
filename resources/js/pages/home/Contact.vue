<template>
    <div>
        <h1 class="theme-heading">{{ $t('contact.title') }}</h1>
        <iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&height=600&hl=nl&q=Onderwijsboulevard%20215+(De%20Gouden%20Draak)&ie=UTF8&t=&z=17&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/nl/cirkel-straal-kaart/">Cirkel op kaart Google</a></iframe>
    </div>
</template>

<script>
    export default {
        name: "Contact"
    }
</script>

<style scoped>
    iframe {
        width: 80%;
        display: block;
        margin: 0 auto;
        border-radius: 20px;
        box-shadow: 0 0 5px 0 black;
    }
</style>
