import {http} from './config'

export default {

    getAllUsers:() => {
        return http.get('users')
    },

    createUser:(user) => {
        return http.post('users', user)
    },

    updateUser:(user) => {
        return http.put('users', user)
    },

    deleteUser:(user) => {
        return http.delete('users', {data: user})
    }

}