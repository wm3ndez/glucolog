class Routes(object):
    utils_states = '/utils/state'

    auth_login = '/auth/login'
    auth_register = '/auth/register'

    user_profile = '/users/me'

    user_avatar = '/users/me/avatar'

    user_weight_list = '/users/me/weight'
    user_weight_details = '/users/me/weight/<int:id>'
