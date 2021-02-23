import { getField } from 'vuex-map-fields';

let getters = {
    getField,
    errors: state => {
        return state.errors
    },
    atividades: state => {
        return state.atividades
    },
    cliente: state => {
        return state.cliente
    }
}

export default getters
