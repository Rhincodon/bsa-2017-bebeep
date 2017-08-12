import validate from 'validate.js';

export const RegisterValidator = {
    last_name: (data) => {
        const valid = data.trim() !== "";
        let error = valid ? "" : "Last name is required";
        return {
            valid,
            error
        };
    },
    first_name: (data) => {
        const valid = data.trim() !== "";
        let error = valid ? "" : "First name is required";
        return {
            valid,
            error
        };
    },
    phone: (data) => {
        const valid = !!data.match(/^[0-9]{1,15}$/);
        let error = valid ? "" : "Phone is required, and must contain digits not more 15";
        return {
            valid,
            error
        };
    },
    email: (data) => {
        const result = validate.single(data, { presence: true, email: true });
        let error = result ? result.join(", ") : "";
        return {
            valid: !result,
            error
        };
    },
    birth_date: (data) => {
        const valid = data.trim() !== "";
        let error = valid ? "" : "Phone is required";
        return {
            valid,
            error
        };
    },
    role: (role_driver, role_passenger) => {
        const valid = role_driver || role_passenger;
        let error = valid ? "" : "Choose your role";
        return {
            valid,
            error
        };
    },
    password: (data) => {
        const valid = data.length > 5;
        let error = valid ? "" : "Password must be more or equal 6 characters";
        return {
            valid,
            error
        };
    },
    password_confirmation: (password_confirmation, password) => {
        const valid = password === password_confirmation;
        let error = valid ? "" : "Repeated password does not match";
        return {
            valid,
            error
        };
    },
};

export const RegisterValidate = (data = {
    last_name: "",
    first_name: "",
    phone: "",
    email: "",
    birth_date: "",
    role_passenger: "",
    role_driver: "",
    password: "",
    password_confirmation: ""
}) => {
    let result = {
        valid: true,
        errors: {}
    };
    let storeResult = (result, valid, field) => {
        result.valid = result.valid && valid.valid;
        if (!result.valid) {
            result.errors[field] = valid.error;
        }
        return result;
    };
    for (let field of Object.keys(data)) {
        if (field === "role_passenger" || field === "role_driver" || field === "password_confirmation") {
            continue;
        }
        storeResult(result, RegisterValidator[field](data[field]), field);
    }
    storeResult(result, RegisterValidator.role(
        data['role_driver'],
        data['role_passenger']),
        'role'
    );
    storeResult(
        result,
        RegisterValidator.password_confirmation(data['password_confirmation'], data['password']),
        'password_confirmation'
    );
    return result;
};

export const VerifyValidator = {
    token(data) {
        const valid = data.trim() !== "";
        let error = valid ? "" : "Token is empty";
        return {
            valid,
            error
        };
    }
};

export const PasswordChangeValidator = {
    passwordIsChanged: (new_password, current_password) => {
        const valid = current_password !== new_password;
        let error = valid ? "" : "You already have this password, enter another one.";
        return {
            valid,
            error
        };
    },
};

export const PasswordChangeValidate = (data = {
    current_password: "",
    password: "",
    password_confirmation: ""
}) => {
    let result = {
        valid: true,
        errors: {}
    };
    let storeResult = (result, valid, field) => {
        result.valid = result.valid && valid.valid;
        if (!result.valid) {
            result.errors[field] = valid.error;
        }
        return result;
    };

    storeResult(
        result,
        RegisterValidator.password(data['current_password']),
        'current_password'
    );
    storeResult(
        result,
        RegisterValidator.password(data['password']),
        'password'
    );
    storeResult(
        result,
        RegisterValidator.password_confirmation(data['password_confirmation'], data['password']),
        'password_confirmation'
    );
    storeResult(
        result,
        PasswordChangeValidator.passwordIsChanged(data['password'], data['current_password']),
        'password'
    );

    return result;
};

export const ProfileValidator = {
    about_me: (data) => {
        const valid = data.length <= 500;
        let error = valid ? "" : "About us must be less or equal 500 characters";
        return {
            valid,
            error
        };
    },
};

export const ProfileValidate = (data = {
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    birth_date: "",
    role_passenger: "",
    role_driver: "",
    about_me: ""
}) => {
    let result = {
        valid: true,
        errors: {}
    };
    let storeResult = (result, valid, field) => {
        result.valid = result.valid && valid.valid;
        if (!result.valid) {
            result.errors[field] = valid.error;
        }
        return result;
    };

    for (let field of Object.keys(data)) {
        if (field === "role_passenger" || field === "role_driver" || field === "about_me") {
            continue;
        }
        storeResult(result, RegisterValidator[field](data[field]), field);
    }

    storeResult(result, RegisterValidator.role(
        data['role_driver'],
        data['role_passenger']),
        'role'
    );
    storeResult(result, ProfileValidator.about_me(data['about_me']), 'about_me');

    return result;
};

const UserService = {
    RegisterValidator,
    RegisterValidate,
    VerifyValidator
};

export default UserService;
