import * as React from 'react'
import {Dispatch, FC} from 'react'
import Form from "react-bootstrap/Form";
import {WizardData} from "./Wizard";

interface Props {
    provinces: string[],
    data: WizardData;
    setData: Dispatch<WizardData>;
}

const Province: FC<Props> = ({provinces, data, setData}: Props) => {
    const handleChange = (event) => {
        setData({...data, province: event.target.value})
    }

    return (
        <Form.Group controlId="formGridAddress1">
            <Form.Label>Województwo</Form.Label>
            <Form.Control as="select" name="province" size="lg" value={data.province} onChange={handleChange}>
                {provinces.map((province, key) => (
                    <option key={key}>{province}</option>
                ))}
            </Form.Control>
        </Form.Group>
    )
}

export default Province
