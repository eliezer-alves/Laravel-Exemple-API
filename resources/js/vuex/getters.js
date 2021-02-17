import { getField } from 'vuex-map-fields';

let getters = {
    getField,
    atividades: state => {
        return state.atividades
    }
}

export default getters
