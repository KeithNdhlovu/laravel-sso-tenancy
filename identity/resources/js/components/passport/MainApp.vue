<script>
    import Clients from "./Clients.vue"
    import AuthorizedClients from "./AuthorizedClients.vue"
    import PersonalAccessTokens from "./PersonalAccessTokens.vue"

    export default {
        components: {
            Clients,
            AuthorizedClients,
            PersonalAccessTokens,
        }
    }

</script>
<template>
    OAuth Stuff

    <Clients />
    <AuthorizedClients />
    <PersonalAccessTokens />
</template>