export default class Endpoints {
    static settings = (): string => `/api/settings`
    static provinces = (): string => `/api/provinces`
    static keys = (): string => `/api/date-keys/keys`
    static batches = (): string => `/api/date-keys/batches`
}
