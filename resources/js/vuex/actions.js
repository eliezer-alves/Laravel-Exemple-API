import { API_URL, header, params } from '../config/api'

let actions = {
    async login({ commit }, cliente) {

        cliente.username = await cliente.username.replace(/[^\d]+/g, '');
        console.log(cliente.username);

        params.append('username', cliente.username);
        params.append('password', cliente.password);

        return await axios.post(`${API_URL}/oauth/token`, params, header)
            .then(res => {
                if (res.status === 200)
                // commit('CREATE_CLIENTE', cliente)
                return res;
            }).catch(err => {
                commit('GET_ERRORS', err.response.data)
                // console.log(err.response.data.error);
                // console.log('error', Object.assign({}, err));

            })
    },
    createAtividade({ commit }, atividade) {
        return axios.post('http://localhost:8000/api/atividade_comercial', atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    fetchAtividades({ commit }) {
        return axios.get('http://localhost:8000/api/atividade_comercial')
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    updateAtividade({ commit }, atividade) {
        return axios.put(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`, { ...atividade })
            .then(res => {
                console.log(res);
                commit('UPDATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    deleteAtividade({ commit }, atividade) {
        return axios.delete(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.status === 200)
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    async createCliente({ commit }, cliente) {
        console.log(cliente);
        cliente.cnpj = cliente.cnpj.replace(/[^\d]+/g, '');

        console.log(cliente);
        return axios.post(`http://localhost:8000/api/cliente`, cliente)
            .then(res => {
                if (res.status === 200)
                    commit('CREATE_CLIENTE', cliente)
                return res;
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    }
}

export default actions
