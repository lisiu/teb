import * as React from 'react'
import {Dispatch, FC, useEffect, useState} from "react";
import Form from "react-bootstrap/Form";
import axios from "axios";
import Endpoints from "../../sdk/endpoints";
import {WizardData} from "./Wizard";

interface ProvinceProps {
    data: WizardData;
    setData: Dispatch<WizardData>;
}

const Province: FC<ProvinceProps> = ({data, setData}: ProvinceProps) => {
    const [provinces, setProvinces] = useState<string[]>([])
    useEffect(() => {
        axios.get(Endpoints.provinces()).then(result => {
            setProvinces(result.data)
            setData({...data, province: result.data[0]})
        })
    }, [])
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
