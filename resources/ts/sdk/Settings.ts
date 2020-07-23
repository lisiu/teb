export interface Settings {
    dateRangeStart: string;
    dateRangeStop: string;
    keyLettersFrom: string;
    keyLettersTo: string;
}

export default class SettingsFactory {
    static make(data: object): Settings {
        return {
            dateRangeStart: data['date-range-start'],
            dateRangeStop: data['date-range-stop'],
            keyLettersFrom: data['key-letters-from'],
            keyLettersTo: data['key-letters-to'],
        }
    }
}
