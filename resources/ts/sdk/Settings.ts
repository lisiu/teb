export interface Settings {
    dateRangeStart: string;
    dateRangeStop: string;
    keyLettersFrom: number;
    keyLettersTo: number;
}

export default class SettingsFactory {
    static make(data: object): Settings {
        return {
            dateRangeStart: data['date-range-start'],
            dateRangeStop: data['date-range-stop'],
            keyLettersFrom: parseInt(data['key-letters-from'], 10) || 10,
            keyLettersTo: parseInt(data['key-letters-to'], 10) || 10,
        }
    }
}
